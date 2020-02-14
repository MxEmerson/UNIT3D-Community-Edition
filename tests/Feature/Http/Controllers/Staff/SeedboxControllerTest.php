<?php

namespace Tests\Feature\Http\Controllers\Staff;

use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Staff\SeedboxController
 */
class SeedboxControllerTest extends TestCase
{
    /**
     * @test
     */
    public function destroy_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $seedbox = factory(\App\Models\Seedbox::class)->create();
        $user = factory(\App\Models\User::class)->create();

        $response = $this->actingAs($user)->delete(route('staff.seedboxes.destroy', ['id' => $seedbox->id]));

        $response->assertRedirect(withSuccess('Seedbox Record Has Successfully Been Deleted'));
        $this->assertDeleted($staff);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $user = factory(\App\Models\User::class)->create();

        $response = $this->actingAs($user)->get(route('staff.seedboxes.index'));

        $response->assertOk();
        $response->assertViewIs('Staff.seedbox.index');
        $response->assertViewHas('seedboxes');

        // TODO: perform additional assertions
    }

    // test cases...
}
