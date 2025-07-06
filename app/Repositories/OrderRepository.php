<?php

namespace App\Repositories;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

/**
 * Class OrderService
 * @package App\Services
 */
class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    protected $model;

    public function __construct(Order $model) {
        $this->model = $model;
    }

    public function pagination(
        array $column = ['*'], 
        array $condition = [], 
        int $perpage = 1, 
        array $extend = [], 
        array $orderBy = ['id', 'DESC'],
        array $join = [], 
        array $relations = [],
        array $rawQuery = [],
        int $page = 1
    ) {
        $query = $this->model->select($column);
    
        return $query
            ->keyword($condition['keyword'] ?? null, ['fullname', 'phone', 'email', 'address', 'code'], ['field' => 'name', 'relation' => 'products'])
            ->publish($condition['publish'] ?? null)
            ->customDropdownFilter($condition['dropdown'] ?? null)
            ->customWhere($condition['where'] ?? null)
            ->customWhereRaw($rawQuery['whereRaw'] ?? null)
            ->relation($relations ?? null)
            ->relationCount($relations ?? null)
            ->customJoin($join ?? null)
            ->extendCustomGroupBy($extend['groupBy'] ?? null)
            ->extendCustomOrderBy($orderBy ?? ['id', 'DESC'])
            ->forPage($page, $perpage)
            ->paginate($perpage)
            ->withQueryString()
            ->withPath(env('APP_URL') . ($extend['path'] ?? ''));
    }

    public function getOrderByTime($month, $year, $previousMonth, $previousYear) {
        return $this->model
            ->selectRaw('
                COUNT(*) as total_orders,
                COUNT(CASE WHEN confirm = "cancel" THEN 1 END) as cancel_orders,
                COUNT(CASE WHEN MONTH(created_at) = ? AND YEAR(created_at) = ? THEN 1 END) as current_month_orders,
                COUNT(CASE WHEN MONTH(created_at) = ? AND YEAR(created_at) = ? THEN 1 END) as previous_month_orders,
                (COUNT(CASE WHEN confirm = "cancel" THEN 1 END) / COUNT(*)) * 100 as cancel_percentage
            ', [$month, $year, $previousMonth, $previousYear])
            ->first();
    }

    public function revenueOrders($currentMonth, $currentYear, $previousMonth, $previousYear) {
        $currentMonthRevenue = $this->model
            ->join('order_products', 'order_products.order_id', '=', 'orders.id')
            ->whereYear('orders.created_at', '=', $currentYear)
            ->whereMonth('orders.created_at', '=', $currentMonth)
            ->where('orders.payment', '=', 'paid')
            ->where('orders.confirm', '=', 'confirm')
            ->sum(DB::raw('order_products.price * order_products.qty'));
    
        $previousMonthRevenue = $this->model
            ->join('order_products', 'order_products.order_id', '=', 'orders.id')
            ->whereYear('orders.created_at', '=', $previousYear)
            ->whereMonth('orders.created_at', '=', $previousMonth)
            ->where('orders.payment', '=', 'paid')
            ->where('orders.confirm', '=', 'confirm')
            ->sum(DB::raw('order_products.price * order_products.qty'));
    
        return [
            'current_month_revenue' => $currentMonthRevenue,
            'previous_month_revenue' => $previousMonthRevenue,
        ];
    }

    public function revenueByYear($year) {
        $currentYearData = $this->model
            ->select(
                DB::raw('
                    months.month,
                    COALESCE(SUM(JSON_UNQUOTE(JSON_EXTRACT(orders.cart, "$.cartTotal"))), 0) as daily_revenue
                ')
            )
            ->from(DB::raw('(
                SELECT 1 AS month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4
                UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8
                UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
            ) as months'))
            ->leftJoin('orders', function($join) use ($year) {
                $join->on(DB::raw('months.month'), '=', DB::raw('MONTH(orders.created_at)'))
                    ->where('orders.payment', '=', 'paid')
                    ->where('orders.confirm', '=', 'confirm')
                    ->where(DB::raw('YEAR(orders.created_at)'), '=', $year);
            })
            ->groupBy('months.month')
            ->orderBy('months.month')
            ->get();
    
        $previousYearData = $this->model
            ->select(
                DB::raw('
                    months.month,
                    COALESCE(SUM(JSON_UNQUOTE(JSON_EXTRACT(orders.cart, "$.cartTotal"))), 0) as daily_revenue
                ')
            )
            ->from(DB::raw('(
                SELECT 1 AS month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4
                UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8
                UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
            ) as months'))
            ->leftJoin('orders', function($join) use ($year) {
                $join->on(DB::raw('months.month'), '=', DB::raw('MONTH(orders.created_at)'))
                    ->where('orders.payment', '=', 'paid')
                    ->where('orders.confirm', '=', 'confirm')
                    ->where(DB::raw('YEAR(orders.created_at)'), '=', $year - 1);
            })
            ->groupBy('months.month')
            ->orderBy('months.month')
            ->get();
    
        $currentYearTotal = $currentYearData->sum('daily_revenue');
        $previousYearTotal = $previousYearData->sum('daily_revenue');
    
        $percentageChange = $previousYearTotal > 0 
            ? round(($currentYearTotal - $previousYearTotal) / $previousYearTotal * 100, 2)
            : ($currentYearTotal > 0 ? 100 : 0);
    
        return [
            'current_year_data' => $currentYearData,
            'previous_year_data' => $previousYearData,
            'current_year_total' => $currentYearTotal,
            'previous_year_total' => $previousYearTotal,
            'percentage_change' => $percentageChange
        ];
    }
    
    public function revenue7Day() {
        $current7DayData = $this->model
            ->select(
                DB::raw('
                    dates.date,
                    COALESCE(SUM(JSON_UNQUOTE(JSON_EXTRACT(orders.cart, "$.cartTotal"))), 0) as daily_revenue
                ')
            )
            ->from(DB::raw('(
                SELECT DATE_SUB(CURDATE(), INTERVAL n.n DAY) AS date
                FROM (
                    SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 
                    UNION ALL SELECT 3 UNION ALL SELECT 4 
                    UNION ALL SELECT 5 UNION ALL SELECT 6
                ) AS n
            ) as dates'))
            ->leftJoin('orders', function($join) {
                $join->on(DB::raw('dates.date'), '=', DB::raw('DATE(orders.created_at)'))
                    ->where('orders.payment', '=', 'paid')
                    ->where('orders.confirm', '=', 'confirm');
            })
            ->groupBy('dates.date')
            ->orderBy('dates.date', 'ASC')
            ->get();
    
        $previous7DayData = $this->model
            ->select(
                DB::raw('
                    DATE_SUB(dates.date, INTERVAL 7 DAY) as date,
                    COALESCE(SUM(JSON_UNQUOTE(JSON_EXTRACT(orders.cart, "$.cartTotal"))), 0) as daily_revenue
                ')
            )
            ->from(DB::raw('(
                SELECT DATE_SUB(CURDATE(), INTERVAL n.n DAY) AS date
                FROM (
                    SELECT 7 AS n UNION ALL SELECT 8 UNION ALL SELECT 9 
                    UNION ALL SELECT 10 UNION ALL SELECT 11 
                    UNION ALL SELECT 12 UNION ALL SELECT 13
                ) AS n
            ) as dates'))
            ->leftJoin('orders', function($join) {
                $join->on(DB::raw('dates.date'), '=', DB::raw('DATE(orders.created_at)'))
                    ->where('orders.payment', '=', 'paid')
                    ->where('orders.confirm', '=', 'confirm');
            })
            ->groupBy('dates.date')
            ->orderBy('dates.date', 'ASC')
            ->get();
    
        $current7DayTotal = $current7DayData->sum('daily_revenue');
        $previous7DayTotal = $previous7DayData->sum('daily_revenue');
    
        $percentageChange = $previous7DayTotal > 0 
            ? round(($current7DayTotal - $previous7DayTotal) / $previous7DayTotal * 100, 2)
            : ($current7DayTotal > 0 ? 100 : 0);
    
        return [
            'current_7day_data' => $current7DayData,
            'previous_7day_data' => $previous7DayData,
            'current_7day_total' => $current7DayTotal,
            'previous_7day_total' => $previous7DayTotal,
            'percentage_change' => $percentageChange
        ];
    }
    
    public function revenueMonth($currentMonth, $currentYear) {
        $currentMonthData = $this->model
            ->select(
                DB::raw('
                    DAY(created_at) as day,
                    COALESCE(SUM(JSON_UNQUOTE(JSON_EXTRACT(orders.cart, "$.cartTotal"))), 0) as daily_revenue
                ')
            )
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('payment', '=', 'paid')
            ->where('confirm', '=', 'confirm')
            ->groupBy('day')
            ->orderBy('day')
            ->get();
    
        $previousMonth = ($currentMonth == 1) ? 12 : $currentMonth - 1;
        $previousYear = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;
    
        $previousMonthData = $this->model
            ->select(
                DB::raw('
                    DAY(created_at) as day,
                    COALESCE(SUM(JSON_UNQUOTE(JSON_EXTRACT(orders.cart, "$.cartTotal"))), 0) as daily_revenue
                ')
            )
            ->whereMonth('created_at', $previousMonth)
            ->whereYear('created_at', $previousYear)
            ->where('payment', '=', 'paid')
            ->where('confirm', '=', 'confirm')
            ->groupBy('day')
            ->orderBy('day')
            ->get();
    
        // Tính tổng doanh thu tháng này và tháng trước
        $currentMonthTotal = $currentMonthData->sum('daily_revenue');
        $previousMonthTotal = $previousMonthData->sum('daily_revenue');
    
        // Tính phần trăm thay đổi
        $percentageChange = $previousMonthTotal > 0 
            ? round(($currentMonthTotal - $previousMonthTotal) / $previousMonthTotal * 100, 2)
            : ($currentMonthTotal > 0 ? 100 : 0);
    
        return [
            'current_month_data' => $currentMonthData,
            'previous_month_data' => $previousMonthData,
            'current_month_total' => $currentMonthTotal,
            'previous_month_total' => $previousMonthTotal,
            'percentage_change' => $percentageChange
        ];
    }

    public function getOrderStatusStats($type = 'month', $time = null) {
        $currentQuery = $this->model
            ->select(
                DB::raw('
                    COUNT(CASE WHEN confirm = "confirm" THEN 1 END) as completed_orders,
                    COUNT(CASE WHEN confirm = "pending" THEN 1 END) as processing_orders,
                    COUNT(CASE WHEN confirm = "cancel" THEN 1 END) as canceled_orders
                ')
            );
    
        $previousQuery = clone $currentQuery;
    
        if ($type === 'month') {
            $currentQuery->whereYear('created_at', $time ?? date('Y'))
                         ->whereMonth('created_at', date('m'));
    
            $previousQuery->whereYear('created_at', $time ?? date('Y'))
                          ->whereMonth('created_at', date('m', strtotime('-1 month')));
        } elseif ($type === 'year') {
            $currentQuery->whereYear('created_at', $time ?? date('Y'));
    
            $previousQuery->whereYear('created_at', ($time ?? date('Y')) - 1);
        } elseif ($type === '7days') {
            $currentQuery->whereBetween('created_at', [now()->subDays(7), now()]);
            $previousQuery->whereBetween('created_at', [now()->subDays(14), now()->subDays(7)]);
        }
    
        $current = $currentQuery->first();
        $previous = $previousQuery->first();
    
        $current_total = ($current->completed_orders ?? 0) + ($current->processing_orders ?? 0) + ($current->canceled_orders ?? 0);
        $previous_total = ($previous->completed_orders ?? 0) + ($previous->processing_orders ?? 0) + ($previous->canceled_orders ?? 0);
    
        $calculateChange = function ($currentValue, $previousValue) {
            if ($previousValue > 0) {
                return round((($currentValue - $previousValue) / $previousValue) * 100, 2);
            }
            return $currentValue > 0 ? 100 : 0;
        };
    
        return [
            'current' => [
                'total_orders' => $current_total,
                'completed_orders' => $current->completed_orders ?? 0,
                'processing_orders' => $current->processing_orders ?? 0,
                'canceled_orders' => $current->canceled_orders ?? 0,
            ],
            'previous' => [
                'total_orders' => $previous_total,
                'completed_orders' => $previous->completed_orders ?? 0,
                'processing_orders' => $previous->processing_orders ?? 0,
                'canceled_orders' => $previous->canceled_orders ?? 0,
            ],
            'percentage_change' => [
                'total_orders' => $calculateChange($current_total, $previous_total),
                'completed_orders' => $calculateChange($current->completed_orders ?? 0, $previous->completed_orders ?? 0),
                'processing_orders' => $calculateChange($current->processing_orders ?? 0, $previous->processing_orders ?? 0),
                'canceled_orders' => $calculateChange($current->canceled_orders ?? 0, $previous->canceled_orders ?? 0),
            ]
        ];
    }
}