<?php

namespace Admin;

use App\Http\Resources\Admin\ModeResource;
use App\Models\Mode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ModeTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->authUser();
    }

    public function authUser()
    {
        Sanctum::actingAs(User::factory()->create());
    }

    public function test_index(): void
    {
        $modes = Mode::factory()->count(3)->create();
        $response = $this->get('api/admin-panel/modes');

        $response
            ->assertJson(ModeResource::collection($modes)->response()->getData(true))
            ->assertStatus(200);
    }

    public function test_show(): void
    {
        $mode = Mode::factory()->create();
        $response = $this->get("api/admin-panel/modes/{$mode->slug}");

        $response
            ->assertJson([
                'mode' => (new ModeResource($mode))->response()->getData(true)['data']
            ])
            ->assertStatus(200);
    }

    public function test_store(): void
    {
        $mode = Mode::factory()->make();
        $response = $this->post('api/admin-panel/modes', $mode->toArray());

        $expected = (new ModeResource($mode))->response()->getData(true)['data'];
        $response
            ->assertJsonStructure([
                'mode' => [
                    'id',
                    'name',
                    'slug',
                    'created_at',
                    'updated_at',
                ],
                'message'
            ]);

        $response->assertJsonFragment([
            'name' => $expected['name'],
        ]);

        $response->assertStatus(200);
    }
}
