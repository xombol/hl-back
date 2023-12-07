<?php

namespace App\Http\Repositories;

use App\Models\House;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class HousesRepository
{
    /**
     * @param mixed $filters
     * @return LengthAwarePaginator
     */
    public function getHousesByFilter(mixed $filters): LengthAwarePaginator
    {
        return House::query()
            ->when($filters["name"] ?? false, function ($query, $value) {
                $query->where('name', 'LIKE', '%' . $value . '%');
            })
            ->when($filters["bedrooms"] ?? false, function ($query, $value) {
                $query->where('bedrooms', $value);
            })
            ->when($filters["bathrooms"] ?? false, function ($query, $value) {
                $query->where('bathrooms', $value);
            })
            ->when($filters["storeys"] ?? false, function ($query, $value) {
                $query->where('storeys', $value);
            })
            ->when($filters["garages"] ?? false, function ($query, $value) {
                $query->where('garages', $value);
            })
            ->when($filters["min_price"] ?? false, function ($query, $value) {
                $query->where('price', '>=', $value);
            })
            ->when($filters["max_price"] ?? false, function ($query, $value) {
                $query->where('price', '<=', $value);
            })
            ->orderByDesc('id')
            ->paginate(10);
    }
}
