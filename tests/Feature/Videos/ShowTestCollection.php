<?php

namespace Tests\Feature\Videos;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowCollectionTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_example(): void
    {
        $video = Video::factory()->count(3)->create();
        $response = $this->getJson(route('api.videos.index'));
        $response ->assertExactJson([
         'data'=>[
             [
                 'type'=> 'video',
                 'id'=> (string)$video[0]->getRouteKey(),
                 'attributes'=> [
                     'title'=> $video[0]->title,
                     'slug'=> $video[0]->slug,
                     'description'=> $video[0]->description,
                    
 
                 ],
                 'links'=> [
                     'self'=> route('api.videos.show',$video[0])
                 ]
             ],
             [
                 'type'=> 'video',
                 'id'=> (string)$video[1]->getRouteKey(),
                 'attributes'=> [
                     'title'=> $video[1]->title,
                     'slug'=> $video[1]->slug,
                     'description'=> $video[1]->description,
                     
                 ],
                 'links'=> [
                     'self'=> route('api.videos.show',$video[1])
                 ]
             ],
             [
                 
                 'type'=> 'video',
                 'id'=> (string)$video[2]->getRouteKey(),
                 'attributes'=> [
                     'title'=> $video[2]->title,
                     'slug'=> $video[2]->slug,
                     'description'=> $video[2]->description,
                    
 
                 ],
                 'links'=> [
                     'self'=> route('api.videos.show',$video[2])
                 ]
             ],
         ],'links'=> [
             'self'=> route('api.videos.index')
         ]
     ]);
 }
}


