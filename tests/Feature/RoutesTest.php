<?php

namespace Tests\Feature;

use App\User;
use App\brand;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class RoutesTest extends TestCase
{

    public function testRouteAccessIndexTest()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/');

        $response->assertStatus(200);
        if($user) {
            $user->delete();
        }
    }

    public function testRouteAccessDashboardTest()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/dashboard');

        $response->assertStatus(200);
        if($user) {
            $user->delete();
        }
    }

    public function testRouteAccessDashboardDUKTest()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/dashboard/duk');

        $response->assertStatus(200);
        if($user) {
            $user->delete();
        }
    }

    public function testRouteAccessDashboardChattingTest()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/dashboard/chatting');

        $response->assertStatus(200);
        if($user) {
            $user->delete();
        }
    }

    public function testRouteAccessDashboardBrandTest()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/dashboard/brand');

        $response->assertStatus(200);
        if($user) {
            $user->delete();
        }
    }

    public function testRouteAccessDashboardImageFeedbackTest()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/dashboard/image-feedback');

        $response->assertStatus(200);
        if($user) {
            $user->delete();
        }
    }

    public function testRouteAccessDashboardImageComparerTest()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/dashboard/image-comparer');

        $response->assertStatus(200);
        if($user) {
            $user->delete();
        }
    }

    // public function testRouteAccessDashboardBrandEditTest()
    // {
    //     $user = factory(User::class)->create();
    //     $user->position = 'admin';
    //     $user->save();

    //     $response = $this->actingAs($user)
    //                      ->withSession(['foo' => 'bar'])
    //                      ->get('/dashboard/brand/edit/'.$user->id);

    //     $response->assertStatus(200);
    //     if($user) {
    //         $user->delete();
    //     }
    // }

    public function testRouteAccessDashboardBrandDeleteTest()
    {
        $user = factory(User::class)->create();
        $brand = factory(Brand::class)->create();
        $brand->user_id = $user->id;
        $brand->name = 'routeTesting';
        $brand->save();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/dashboard/brand/delete/'.$brand->id);

        $response->assertStatus(200);
        if($user) {
            $user->delete();
        }
    }

    public function testRouteAccessDashboardChattingUserTest()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/dashboard/chatting/1');

        $response->assertStatus(200);
        if($user) {
            $user->delete();
        }
    }
/*
    public function testRouteAccessDashboardDeleteNotificationTest()
    {
        //THIS
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/dashboard/deleteNotifications/258');

        //Not admin can't reach this page
        $response->assertStatus(200);
        if($user) {
            $user->delete();
        }
    }
*/
    public function testRouteAccessDashboardFilesTest()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/dashboard/files');

        $response->assertStatus(200);
        if($user) {
            $user->delete();
        }
    }

    public function testRouteAccessDashboardOrdersTest()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/dashboard/orders');

        $response->assertStatus(200);
        if($user) {
            $user->delete();
        }
    }

    public function testRouteAccessDashboardOrdersDashboardTest()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/dashboard/orders-dashboard');

        $response->assertStatus(200);
        if($user) {
            $user->delete();
        }
    }

    public function testRouteAccessDashboardUsersTest()
    {
        $user = factory(User::class)->create();
        $user->position='admin';
        $user->save();
        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/dashboard/users');

        $response->assertStatus(200);
        if($user) {
            $user->delete();
        }
    }
    public function testRouteBrandStore()
    { 
        $user = factory(User::class)->create();

        $array=['_token'=>csrf_token(),'title'=>'foo','website'=>'foo','industry'=>'foo','description'=>'foo','isMockTest' => true];
       
        $response = $this->withHeaders(['foo'=>'bar']);
        $response = $this->actingAs($user)
                          ->withSession(['foo' => 'bar'])
                          ->post(route('brand.store'),$array);
    

        brand::orderBy('id', 'desc')->first()->delete();
        
        $response->assertStatus(200);
        if($user) {
            $user->delete();
        }
    }
}
