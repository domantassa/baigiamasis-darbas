<?php

namespace Tests\Unit;

use App\ImageRevision;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImageRevisionTest extends TestCase
{
    public function testImageRevisionCreation()
    {
        $imageRevision = factory(ImageRevision::class)->create();
        $imageRevision = ImageRevision::orderBy('id', 'desc')->first();

        $imageRevisionDoesExists=false;
        if($imageRevision->exists) {
            $imageRevisionDoesExists = true;
        }
        
        $this->assertTrue($imageRevisionDoesExists);

        if($imageRevision->exists) {
            $imageRevision->delete();
        }
    }

    public function testImageRevisionDeletion()
    {
        $imageRevision = factory(ImageRevision::class)->create();
        $imageRevision = ImageRevision::orderBy('id', 'desc')->first();
        if($imageRevision) {
            $imageRevision->delete();
        }
        $imageRevisionDoesNotExists=true;
        if($imageRevision->exists) {
            $imageRevisionDoesNotExists = false;
        }
        $this->assertTrue($imageRevisionDoesNotExists);
    }

    public function testImageRevisionUpdate()
    {
        $imageRevision = factory(ImageRevision::class)->create();
        $this->assertEquals($imageRevision->path, 'userName');

        $imageRevision->path = 'newUserName';
        $imageRevision->save();
        
        $this->assertEquals($imageRevision->path, 'newUserName');
    
        if($imageRevision->exists) {
            $imageRevision->delete();
        }
    }
}