<?php

namespace Tests\Feature\Website;

use App\Http\Resources\Website\ModeResource;
use App\Models\Mode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModeTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        $modes = Mode::factory()->count(3)->create();
        $response = $this->get('api/modes');

        $response
            ->assertJson(ModeResource::collection($modes)->response()->getData(true))
            ->assertStatus(200);
    }

    public function test_show(): void
    {
        $mode = Mode::factory()->create();
        $response = $this->get("api/modes/{$mode->slug}");

        $response
            ->assertJson([
                'mode' => (new ModeResource($mode))->response()->getData(true)['data']
            ])
            ->assertStatus(200);
    }

    public function test_store(): void
    {
        $mode = Mode::factory()->make();
        $response = $this->post('api/modes', $mode->toArray());

        $response
            ->assertJson([
                'mode' => (new ModeResource($mode))->response()->getData(true)['data']
            ])
            ->assertStatus(201);
    }
}
