<?php

class IndexRouteTest extends TestCase
{
    public function testIndex()
    {
        $this->get('/');

        $this->assertEquals(
            'OK',
            $this->response->getContent()
        );
    }
}
