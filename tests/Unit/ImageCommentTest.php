<?php

namespace Tests\Unit;

use App\ImageComment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImageCommentTest extends TestCase
{


    public function testImageCommentCreation()
    {
        $imageComment = factory(ImageComment::class)->create();
        $imageComment = ImageComment::orderBy('id', 'desc')->first();

        $imageCommentDoesExists=false;
        if($imageComment->exists) {
            $imageCommentDoesExists = true;
        }
        
        $this->assertTrue($imageCommentDoesExists);

        if($imageComment->exists) {
            $imageComment->delete();
        }
    }

    public function testImageCommentDeletion()
    {
        $imageComment = factory(ImageComment::class)->create();
        $imageComment = ImageComment::orderBy('id', 'desc')->first();
        if($imageComment) {
            $imageComment->delete();
        }
        $imageCommentDoesNotExists=true;
        if($imageComment->exists) {
            $imageCommentDoesNotExists = false;
        }
        $this->assertTrue($imageCommentDoesNotExists);
    }

    public function testImageCommentUpdate()
    {
        $imageComment = factory(ImageComment::class)->create();
        $this->assertEquals($imageComment->comment, 'exampleComment');

        $imageComment->comment = 'newExampleComment';
        $imageComment->save();
        
        $this->assertEquals($imageComment->comment, 'newExampleComment');
    
        if($imageComment->exists) {
            $imageComment->delete();
        }
    }
}