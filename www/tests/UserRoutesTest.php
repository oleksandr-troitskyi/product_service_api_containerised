<?php

class UserRoutesTest extends TestCase
{
    public function testGetUserProducts()
    {
        $response = $this->call('GET', '/user/products');

        $this->assertEquals(
            401,
            $response->status()
        );
    }

    public function testPostUserProducts()
    {
        $user = \App\Models\User::where('email', 'roselyn62@gmail.com')->first();
        $response = $this->actingAs($user)->call('POST', '/user/products', ['sku' => 'traktor-pro-3']);

        $this->assertEquals(
            201,
            $response->status()
        );
    }

    public function testGetUserProductsAuthenticated()
    {
        $user = \App\Models\User::where('email', 'roselyn62@gmail.com')->first();
        $response = $this->actingAs($user)->call(
            'GET',
            '/user/products'
        );

        $products = $user->purchasedProducts;

        $this->assertEquals(
            200,
            $response->status()
        );
        $this->assertEquals(
            json_encode($products),
            $response->getContent()
        );
    }
}
