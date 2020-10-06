<?php

class GetProductsRouteTest extends TestCase
{
    public function testGetAllProducts()
    {
        $this->get('/products');
        $products = \App\Models\Product::all()->toArray();

        $this->assertEquals(
            \json_encode($products),
            $this->response->getContent()
        );
    }
}
