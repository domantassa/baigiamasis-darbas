<?php

namespace Tests\Unit;

use App\BrandFile;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrandFileTest extends TestCase
{

    public function testBrandFileCreation()
    {
        $brandFile = factory(BrandFile::class)->create();
        $brandFile = BrandFile::orderBy('id', 'desc')->first();

        $brandFileDoesExists=false;
        if($brandFile->exists) {
            $brandFileDoesExists = true;
        }

        $this->assertTrue($brandFileDoesExists);

        if($brandFile->exists) {
            $brandFile->delete();
        }
    }

    public function testBrandFileDeletion()
    {
        $brandFile = factory(BrandFile::class)->create();
        $brandFile = BrandFile::orderBy('id', 'desc')->first();
        if($brandFile) {
            $brandFile->delete();
        }
        $brandDoesNotExists=true;
        if($brandFile->exists) {
            $brandDoesNotExists = false;
        }
        $this->assertTrue($brandDoesNotExists);
    }

    public function testBrandFileUpdate()
    {
        $brandFile = factory(BrandFile::class)->create();
        $this->assertEquals($brandFile->path, 'userName');

        $brandFile->path = 'newUserName';
        $brandFile->save();
        
        $this->assertEquals($brandFile->path, 'newUserName');
    
        if($brandFile->exists) {
            $brandFile->delete();
        }
    }
}