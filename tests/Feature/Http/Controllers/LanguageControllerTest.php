<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LanguageController
 */
class LanguageControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function back_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $language = factory(\App\Models\Language::class)->create();
        $user = factory(\App\Models\User::class)->create();

        $response = $this->actingAs($user)->get(route('back', ['locale' => $language->locale]));

        $response->assertRedirect(withSuccess('Language Changed!'));

        // TODO: perform additional assertions
    }

    // test cases...
}
