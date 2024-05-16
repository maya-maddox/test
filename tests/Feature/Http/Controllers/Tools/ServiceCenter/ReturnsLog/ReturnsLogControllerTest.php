<?php

namespace Tests\Feature\Http\Controllers\Tools\ServiceCenter\ReturnsLog;

use App\Models\Returns;
use App\Models\ServiceCenter;
use App\User;
use Tests\TestCase;

class ReturnsLogControllerTest extends TestCase
{

    /** @test */
    public function edit_loads_the_edit_page() {
        // Authenticate the user
        $this->be(User::factory()->create());

        // Create the relevant database models
        $service_center = ServiceCenter::factory()->create();
        $return = Returns::factory()->create();

        // Make an http request to the page
        $response = $this->get(route('tools.servicecenter.returnslog.edit', ['service_center' => $service_center, 'return' => $return]));

        // Check the status is a 200
        $response->assertStatus(200);

        // Check the right view is returned
        $response->assertViewIs('tools.service-center.returns-log.edit');

        // Check the right variables are given to the view
        $response->assertViewHas('service_center', $service_center);
        $response->assertViewHas('return', $return);
    }

}