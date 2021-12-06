<?php

namespace Tests\Feature\Api\v1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetCapsulesTest extends TestCase
{
    public function test_default()
    {
        $response = $this->get(route('api.v1.all_capsules'));

        $response->assertStatus(200);
    }

    public function test_by_status()
    {
        $response = $this->get(route('api.v1.all_capsules', ['status' => 'active']));

        $response->assertStatus(200);
    }

    public function test_by_name()
    {
        $response = $this->get(route('api.v1.capsule_by_name', ['capsule_serial' => 'C101']));

        $response->assertStatus(200);
    }
}
