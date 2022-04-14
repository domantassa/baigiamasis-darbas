<?php

namespace Tests\Unit;

use App\Message;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageTest extends TestCase
{

    public function testMessageCreation()
    {
        $message = factory(Message::class)->create();
        $message = Message::orderBy('id', 'desc')->first();

        $messageDoesExists=false;
        if($message->exists) {
            $messageDoesExists = true;
        }
        
        $this->assertTrue($messageDoesExists);

        if($message->exists) {
            $message->delete();
        }
    }

    public function testMessageDeletion()
    {
        $message = factory(Message::class)->create();
        $message = Message::orderBy('id', 'desc')->first();
        if($message) {
            $message->delete();
        }
        $messageDoesNotExists=true;
        if($message->exists) {
            $messageDoesNotExists = false;
        }
        $this->assertTrue($messageDoesNotExists);
    }

    public function testMessageUpdate()
    {
        $message = factory(Message::class)->create();
        $this->assertEquals($message->message, 'exampleMessage');

        $message->message = 'newExampleMessage';
        $message->save();
        
        $this->assertEquals($message->message, 'newExampleMessage');
    
        if($message->exists) {
            $message->delete();
        }
    }
}