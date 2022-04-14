<?php

namespace Tests\Unit;

use App\Order;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{

    public function testOrderCreation()
    {
        $order = factory(Order::class)->create();
        $order = Order::orderBy('id', 'desc')->first();

        $orderDoesExists=false;
        if($order->exists) {
            $orderDoesExists = true;
        }
        
        $this->assertTrue($orderDoesExists);

        if($order->exists) {
            $order->delete();
        }
    }

    public function testOrderDeletion()
    {
        $order = factory(Order::class)->create();
        $order = Order::orderBy('id', 'desc')->first();
        if($order) {
            $order->delete();
        }
        $orderDoesNotExists=true;
        if($order->exists) {
            $orderDoesNotExists = false;
        }
        $this->assertTrue($orderDoesNotExists);
    }

    public function testOrderUpdate()
    {
        $order = factory(Order::class)->create();
        $this->assertEquals($order->type, 'exampleType');

        $order->type = 'newExampleType';
        $order->save();
        
        $this->assertEquals($order->type, 'newExampleType');
    
        if($order->exists) {
            $order->delete();
        }
    }
}