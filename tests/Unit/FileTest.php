<?php

namespace Tests\Unit;

use App\file;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileTest extends TestCase
{

    public function testFileCreation()
    {
        $file = factory(file::class)->create();
        $file = file::orderBy('id', 'desc')->first();

        $fileDoesExists=false;
        if($file->exists) {
            $fileDoesExists = true;
        }
        
        $this->assertTrue($fileDoesExists);

        if($file->exists) {
            $file->delete();
        }
    }

    public function testFileDeletion()
    {
        $file = factory(file::class)->create();
        $file = file::orderBy('id', 'desc')->first();
        if($file) {
            $file->delete();
        }
        $fileDoesNotExists=true;
        if($file->exists) {
            $fileDoesNotExists = false;
        }
        $this->assertTrue($fileDoesNotExists);
    }

    public function testFileUpdate()
    {
        $file = factory(file::class)->create();
        $this->assertEquals($file->path, 'userName');

        $file->path = 'newUserName';
        $file->save();
        
        $this->assertEquals($file->path, 'newUserName');
    
        if($file->exists) {
            $file->delete();
        }
    }
}