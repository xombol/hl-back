<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HouseResource extends JsonResource
{
    /**
     * Transforms the House model instance into an array.
     *
     * @param  Request $request The incoming request instance.
     * @return array<string, mixed> The transformed house data.
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
