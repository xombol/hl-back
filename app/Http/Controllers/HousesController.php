<?php

namespace App\Http\Controllers;

use App\Http\Repositories\HousesRepository;
use App\Http\Requests\HouseFilterRequest;
use Illuminate\Http\JsonResponse;

class HousesController extends Controller
{
    /**
     *
     * Get houses + filter data
     *
     * @param HousesRepository $repository
     * @param HouseFilterRequest $request
     * @return JsonResponse
     */
    public function index(HousesRepository $repository, HouseFilterRequest $request): JsonResponse
    {
        $filters = $request->input('filters', []);

        $houses = $repository->getHousesByFilter($filters);

        return response()->json($houses);
    }
}
