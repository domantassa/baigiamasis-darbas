<?php

namespace Tests\Unit;

use App\FileNotification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileNotificationTest extends TestCase
{

    public function testFileNotificationCreation()
    {
        $fileNotification = factory(FileNotification::class)->create();
        $fileNotification = FileNotification::orderBy('id', 'desc')->first();

        $fileNotificationDoesExists=false;
        if($fileNotification->exists) {
            $fileNotificationDoesExists = true;
        }
        
        $this->assertTrue($fileNotificationDoesExists);

        if($fileNotification->exists) {
            $fileNotification->delete();
        }
    }

    public function testFileNotificationDeletion()
    {
        $fileNotification = factory(FileNotification::class)->create();
        $fileNotification = FileNotification::orderBy('id', 'desc')->first();
        if($fileNotification) {
            $fileNotification->delete();
        }
        $fileNotificationDoesNotExists=true;
        if($fileNotification->exists) {
            $fileNotificationDoesNotExists = false;
        }
        $this->assertTrue($fileNotificationDoesNotExists);
    }

    public function testFileNotificationUpdate()
    {
        $fileNotification = factory(FileNotification::class)->create();
        $this->assertEquals($fileNotification->link, 'exampleLink');

        $fileNotification->link = 'newExampleLink';
        $fileNotification->save();
        
        $this->assertEquals($fileNotification->link, 'newExampleLink');
    
        if($fileNotification->exists) {
            $fileNotification->delete();
        }
    }
}