<?php

namespace Tests\Feature\Videos;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_a_single_video()
    {
        $video = Video::factory() ->create();

        $response = $this->getJson(route('api.videos.show',$video));

        $response->assertOk()
            ->assertJson([
                'data' => [
                    'type' => 'video',
                    'id' => (string) $video->id,

                    'attributes' => [
                        'title' => $video->title,
                        'description' => $video->description,
                        'slug' => $video->slug,
                        
                    ],
                    'links' => [
                        'self' => route('api.videos.show',$video)
                    ]
                 ]
            ]);
    }
}