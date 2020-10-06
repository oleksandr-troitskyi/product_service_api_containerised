<?php

class AuthTest extends TestCase
{
    public function testGetAuth()
    {
        $response = $this->call('GET', '/auth');

        $this->assertEquals(
            405,
            $response->status()
        );
    }

    public function testPostAuthWithNoParams()
    {
        $response = $this->call('POST', '/auth');

        $this->assertEquals(
            422,
            $response->status()
        );
    }

    public function testPostAuthWithEmail()
    {
        $response = $this->call('POST', '/auth', ['email' => 'roselyn62@gmail.com']);

        $this->assertEquals(
            422,
            $response->status()
        );
    }

    public function testPostAuthWithWrongEmail()
    {
        $response = $this->call('POST', '/auth', ['email' => 'roselyn62@gmail.com1', 'password' => 'secret']);

        $this->assertEquals(
            401,
            $response->status()
        );
    }

    public function testPostAuthWithCorrectEmail()
    {
        $response = $this->call('POST', '/auth', ['email' => 'roselyn62@gmail.com', 'password' => 'secret']);
        $user = \App\Models\User::where('email', 'roselyn62@gmail.com')->first();

        $this->assertEquals(
            200,
            $response->status()
        );


        $this->assertEquals(
            json_encode(['status' => true, 'api_key' => $user->api_key]),
            $response->getContent()
        );
    }

    
}
