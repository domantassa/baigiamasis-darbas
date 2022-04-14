<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    public function testUserCreation()
    {
        $user = factory(User::class)->create();
        $user = User::orderBy('id', 'desc')->first();

        $userDoesExists=false;
        if($user->exists) {
            $userDoesExists = true;
        }
        
        $this->assertTrue($userDoesExists);

        if($user->exists) {
            $user->delete();
        }
    }
    
    public function testUserDeletion()
    {
        $user = factory(User::class)->create();
        $user = User::orderBy('id', 'desc')->first();
        if($user->exists) {
            $user->delete();
        }
        $userDoesNotExists=true;
        if($user->exists) {
            $userDoesNotExists = false;
        }
        $this->assertTrue($userDoesNotExists);
    }

    public function testUserUpdate()
    {
        $user = factory(User::class)->create();
        $this->assertEquals($user->position, 'user');

        $user->position = 'admin';
        $user->save();
        
        $this->assertEquals($user->position, 'admin');
    
        if($user->exists) {
            $user->delete();
        }
    }

    public function testUserNameShort()
    {
        $user = factory(User::class)->create();

        $user->name = 'ExtraLongNameToTriggerShortening';
        $user->save();
        
        $this->assertEquals($user->userNameShort(10), 'ExtraL...');

        $this->assertEquals($user->userNameShort(15), 'ExtraLongNa...');

        $this->assertEquals($user->userNameShort(20), 'ExtraLongNameToT...');

        $this->assertEquals($user->userNameShort(50), 'ExtraLongNameToTriggerShortening');
    
        if($user->exists) {
            $user->delete();
        }
    }
}
