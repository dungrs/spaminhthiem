<?php 

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;

use App\Repositories\Location\DistrictRepository;
use App\Repositories\Location\ProvinceRepository;

class LocationController extends BackendController {
    protected $districtRepository;
    protected $provinceRepository;

    public function __construct(DistrictRepository $districtRepository, ProvinceRepository $provinceRepository) {
        $this->districtRepository = $districtRepository;
        $this->provinceRepository = $provinceRepository;
    }

    public function getLocation(Request $request) {
        $get = $request->input();
        $data = [];

        if ($get['target'] == 'districts') {
            $province = $this->provinceRepository->findById($get['data']['location_id'], ['code', 'name'], ['districts']);
            if ($province && $province->districts) {
                $data = $province->districts->map(function($district) {
                    return [
                        'value' => $district->code,
                        'label' => $district->name
                    ];
                })->toArray();
            }
        } elseif ($get['target'] == 'wards') {
            $district = $this->districtRepository->findById($get['data']['location_id'], ['code', 'name'], ['wards']);
            if ($district && $district->wards) {
                $data = $district->wards->map(function ($ward) {
                    return [
                        'value' => $ward->code,
                        'label' => $ward->name
                    ];
                })->toArray();
            }
        }

        return response()->json(['data' => $data]);
    }
}
