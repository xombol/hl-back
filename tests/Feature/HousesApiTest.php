<?php

namespace Tests\Feature;

use App\Models\House;
use Tests\TestCase;

class HousesApiTest extends TestCase
{
    /**
     * Test retrieving houses.
     */
    public function testGetHouses(): void
    {
        $response = $this->get('/api/houses');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'price',
                        'bedrooms',
                        'bathrooms',
                        'storeys',
                        'garages',
                        'created_at'
                    ]
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next'
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'path',
                    'per_page',
                    'to',
                    'total',
                ]
            ]);
    }


    /**
     * Test houses filtering by name.
     *
     * @return void
     */
    public function testFilterHousesByName()
    {
        $house = House::factory()->create([
            'name' => 'Test House'
        ]);

        $response = $this->get('/api/houses?filters[name]=' . $house->name);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => $house->name,
            ]);
    }


    /**
     * Test houses filtering by price range.
     *
     * @return void
     */
    public function testFilterHousesByPriceRange()
    {
        $house1 = House::factory()->create([
            'price' => 200000
        ]);

        $house2 = House::factory()->create([
            'price' => 500000
        ]);

        $min_price = 150000;
        $max_price = 250000;

        $response = $this->get('/api/houses?filters[min_price]=' . $min_price . '&filters[max_price]=' . $max_price);

        $response->assertStatus(200)
            ->assertJsonPath('data.0.price', number_format($house1->price, 2, '.', ''))
            ->assertJsonMissing(['price' => number_format($house2->price, 2, '.', '')]);
    }

    /**
     * Test house creation fails with invalid data.
     *
     * @return void
     */
    public function testHouseCreationFailsWithInvalidData(): void
    {
        $invalidFilterData = [
            'min_price' => 'abc',
            'max_price' => 'def',
            'bedrooms' => 'three',
            'bathrooms' => 'one',
            'storeys' => 'one',
            'garages' => 'one',
        ];

        $filters = http_build_query(['filters' => $invalidFilterData]);

        $response = $this->getJson('/api/houses?' . $filters);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'filters.min_price',
                'filters.max_price',
                'filters.bedrooms',
                'filters.bathrooms',
                'filters.storeys',
                'filters.garages'
            ]);
    }


    /**
     * Test house creation fails with invalid data.
     *
     * @return void
     */
    public function testHouseCreationFailsWithInvalidDataOther(): void
    {
        $invalidFilterData = [
            'car' => 'abc',
        ];

        $filters = http_build_query(['filters' => $invalidFilterData]);

        $response = $this->getJson('/api/houses?' . $filters);

        $response->assertStatus(422);
    }

}
