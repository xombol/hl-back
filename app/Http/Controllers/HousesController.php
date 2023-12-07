<?php

namespace App\Http\Controllers;

use App\Http\Repositories\HousesRepository;
use App\Http\Requests\HouseFilterRequest;
use App\Http\Resources\HouseResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HousesController extends Controller
{
    /**
     *
     * Get houses + filter data
     *
     * @param HousesRepository $repository
     * @param HouseFilterRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(HousesRepository $repository, HouseFilterRequest $request): AnonymousResourceCollection
    {
        $filters = $request->input('filters', []);

        $houses = $repository->getHousesByFilter($filters);

        return HouseResource::collection($houses);
    }
}
