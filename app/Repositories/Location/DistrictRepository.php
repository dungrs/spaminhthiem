<?php

namespace App\Repositories\Location;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\Location\DistrictRepositoryInterface;
use App\Models\District;


class DistrictRepository extends BaseRepository implements DistrictRepositoryInterface {
    protected $model;

    public function __construct(District $model) {
        $this->model = $model;
    }
}
