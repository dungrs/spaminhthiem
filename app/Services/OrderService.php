<?php

namespace App\Services;
use App\Services\Interfaces\OrderServiceInterface;
use App\Repositories\OrderRepository;
use Illuminate\Support\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


/**
 * Class OrderService
 * @package App\Services
 */
class OrderService extends BaseService implements OrderServiceInterface
{   
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository) {
        $this->orderRepository = $orderRepository;
    }

    public function paginate($request) {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $perpage = $request->integer('perpage', 6);
        foreach(__('cart') as $key => $val) {
            $condition['dropdown'][$key] = $request->string($key);
        }
        $condition['created_at'] = $request->string('created_at');

        $orders = $this->orderRepository->pagination(
            $this->paginateSelect(), 
            $condition, 
            $perpage, 
            ['path' => 'order/index'],
            ['orders.id', 'DESC'],
        );
    
        if ($orders) {
            return response()->json([
                'status' => 'success',
                'data' => $orders,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "Lấy dữ liệu không thành công!"
            ], 500);
        }
    }
    
    public function getOrder($condition) {
        $orders =  $this->orderRepository->findByCondition(
            $condition,
            true,
            [
                [
                    'table' => 'order_products as op',
                    'on' => [['op.order_id', 'orders.id']]
                ],
                [
                    'table' => 'product_variants as pv',
                    'on' => [['pv.uuid', 'op.uuid']]
                ],
                [
                    'table' => 'provinces as p',
                    'on' => [['p.code', 'orders.province_id']],
                    'type' => 'left'
                ],
                [
                    'table' => 'districts as d',
                    'on' => [['d.code', 'orders.district_id']],
                    'type' => 'left'
                ],
                [
                    'table' => 'wards as w',
                    'on' => [['w.code', 'orders.ward_id']],
                    'type' => 'left'
                ],
            ],
            ['id' => 'ASC'],
            [
                'orders.*', 
                'op.name',
                'op.uuid',
                'op.qty',
                'op.price',
                'op.price_original' ,
                'pv.album',
                'p.name as province_name',
                'd.name as district_name',
                'w.name as ward_name',
            ]
        );

        return $orders;
    }

    public function update($request, $id, $isJsonResponse = true) {
        DB::beginTransaction();
    
        try {
            $payload = $request->except('_token');
            $this->orderRepository->update($id, $payload);
            $condition = [
                ['orders.id', '=', $id]
            ];
            $order = $this->getOrder($condition)->first();
    
            if ($order) {
                DB::commit();
                if ($isJsonResponse) {
                    return response()->json([
                        'status' => 'success',
                        'message' => __('messages.notifications.update_success'),
                        'data' => $order,
                    ], 201);
                }
                return true;
            }
    
            throw new Exception(__('messages.notifications.no_changes'));
        } catch (Exception $e) {
            DB::rollBack();
            if ($isJsonResponse) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('messages.notifications.update_error')
                ], 500);
            }
            return false;
        }
    }

    public function updatePaymentOnline($payload, $order) {
        DB::beginTransaction();
    
        try {
            $orderId = $order->id;
            $this->orderRepository->update($orderId, $payload);
    
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
        }
    }

    public function getOrderByCode($code) {
        $order = $this->orderRepository->findByCondition(
            [
                ['code', '=', $code],
            ]
        );
        return $order;
    }

    public function orderStatistic() {
        $month = now()->month;
        $year = now()->year;
        $previousMonth = ($month == 1) ? 12 : $month - 1;
        $previousYear = ($month == 1) ? $year - 1 : $year;
        
        $getOrderMonth = $this->orderRepository->getOrderByTime($month, $year, $previousMonth, $previousYear);
        $getOrderRevenue = $this->orderRepository->revenueOrders($month, $year, $previousMonth, $previousYear);
        
        $revenueChart = $this->orderRepository->revenueByYear($year);

        return [
            'orderStatisticMonth' => $getOrderMonth,
            'grow' => growth($getOrderMonth->current_month_orders ?? 0, $getOrderMonth->previous_month_orders ?? 0),
            'orderRevenue' => $getOrderRevenue,
            'revenueChart' =>  convertRevenueChartData($revenueChart['current_year_data']),
            'donutChart' => $this->orderRepository->getOrderStatusStats('year'),
        ];
    }

    public function ajaxOrderChart($request) {
        $type = $request->input('chartType');
        $dayText = __('messages.day') . ' ';
        switch ($type) {
            case 1:
                $year = now()->year;
                return [
                    'chart' => convertRevenueChartData($this->orderRepository->revenueByYear($year)['current_year_data'], 'daily_revenue'),
                ];
            case 7:
                return [
                    'chart' => convertRevenueChartData($this->orderRepository->revenue7Day()['current_7day_data'], 'daily_revenue', 'date', $dayText),
                ];
            case 30:
                $currentMonth = now()->month;
                $currentYear = now()->year;

                $dayInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth;
                $allDays = range(1, $dayInMonth);

                $revenueMonthData =  $this->orderRepository->revenueMonth($currentMonth, $currentYear);
                $fullRevenueData = collect($allDays)->map(function ($day) use ($revenueMonthData) {
                    $revenue = $revenueMonthData['current_month_data']->firstWhere('day', $day);
                    return (object)[
                        'day' => $day,
                        'daily_revenue' => $revenue['daily_revenue'] ?? 0
                    ];
                });

                return [
                    'chart' => convertRevenueChartData($fullRevenueData, 'daily_revenue', 'day', $dayText),
                ];
        }
    }

    public function ajaxDonutOrderChart($request) {
        $type = $request->input('chartType');
        switch ($type) {
            case 1:
                return [
                    'dataDonutChart' => $this->orderRepository->getOrderStatusStats('year')
                ];
            case 7:
                return [
                    'dataDonutChart' => $this->orderRepository->getOrderStatusStats('month')
                ];
            case 30:
                return [
                    'dataDonutChart' => $this->orderRepository->getOrderStatusStats('7days')
                ];
        }
    }

    private function paginateSelect() {
        return [
            'id',
            'code',
            'fullname',
            'phone',
            'email',
            'address',
            'method_shipping',
            'description',
            'promotion',
            'cart',
            'customer_id',
            'guest_cookie',
            'method',
            'payment',
            'confirm',
            'delivery',
            'shipping',
            'created_at',
        ];
    }
}