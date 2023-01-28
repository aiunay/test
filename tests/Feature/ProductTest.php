<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use DatabaseTransactions;


    public function test_get_product_by_id()
    {
        $productId =  Product::all()->random(1)->first()->id;

        $this->get('/api/products/' . $productId)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        'name',
                        'manufacturer',
                        'is_visible',
                        'price',
                        'created_at',
                        'updated_at',
                        'material' => [
                            "id",
                            "hallmark",
                            "name",
                        ]
                    ],
                ]
            );
    }


    public function test_add_product()
    {
        $payload = [
            'name' => 'Test Ring',
            'manufacturer' => 'Test Oyo',
            'is_visible' => true,
            'price' => 34.567,
            'currency' => 'USD',
            'material_id' => 1
        ];

        $this->post('api/products', $payload)
            ->assertStatus(201)
            ->assertJson([
                'message' => 'Product created successfully'
            ]);
    }


    public function test_add_product_without_is_visible_param()
    {
        $payload = [
            'name' => 'Test Ring2',
            'manufacturer' => 'Test Oyo2',
            'price' => 56.99,
            'currency' => 'USD',
            'material_id' => 1
        ];

        $this->post('api/products', $payload)
            ->assertStatus(201)
            ->assertJson([
                'message' => 'Product created successfully'
            ]);
    }


    public function test_add_product_without_manufacturer_param()
    {
        $payload = [
            'name' => 'Test Ring3',
            'price' => 56.99,
            'currency' => 'USD',
            'is_visible' => true,
            'material_id' => 1
        ];

        $this->post('api/products', $payload)
            ->assertStatus(400)
            ->assertJson([
                'message' => 'Validation errors',
                'data' => [
                    'manufacturer' => [
                        'The manufacturer field is required.'
                    ]
                ]
            ]);
    }


    public function test_destroy_product()
    {
        $product = Product::create([
            'name' => 'del_test',
            'manufacturer' => 'del_test',
            'is_visible' => false,
            'price' => 34,
            'currency' => 'USD',
            'material_id' => 1
        ]);

        $this->delete('api/products/' . $product->id)
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Product deleted successfully'
            ]);
    }
}
