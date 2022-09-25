<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testVisit()
    {
        // $response = $this->get('api/a');
        $response = $this->get('api/a');

        $response->assertStatus(200);
        // $this->get(route(''))
    }
}
