<?php

namespace Tests\Feature;

use App\User;
use App\brand;
use App\BrandFile;
use App\BrandColor;
use App\ImageRevision;
use App\ImageComment;
use App\Order;
use App\file;
use App\Profile;
use App\FileNotification;
use App\Message;


use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class RelationshipsTest extends TestCase
{

    public function testBrandAndBrandFiles()
    {
        $brand = factory(brand::class)->create();
        $brandFile = factory(BrandFile::class)->create();
        $brandFile->path = 'exampleNewPath';
        $brandFile->brand_id=$brand->id;
        $brandFile->save();
        $brand_brandFiles = $brand->files()->first();

        $this->assertEquals($brand_brandFiles->path, 'exampleNewPath');

        if($brand->exists) {
            $brand->files()->delete();     
            $brand->delete();
            $brandDoesNotExists=true;
        }
    }

    public function testBrandAndBrandColors()
    {
        $brand = factory(brand::class)->create();
    
        $brandColor = factory(BrandColor::class)->create();
        $brandColor->brand_id=$brand->id;
        $brandColor->save();
        $brand_brandColor = $brand->colors()->first();

        $this->assertEquals($brand_brandColor->color_code, 'FFFFFF');

        if($brand->exists) { 
            $brand->colors()->delete();    
            $brand->delete();
            $brandDoesNotExists=true;
        }
    }

    public function testImageRevisionAndImageRevision()
    {
        $imageRevision = factory(ImageRevision::class)->create();
    
        $otherImageRevision = factory(ImageRevision::class)->create();
        $otherImageRevision->original_id=$imageRevision->id;
        $otherImageRevision->save();
        $pulledImageRevision = $imageRevision->imageRevisions()->first();

        $this->assertEquals($pulledImageRevision->id, $otherImageRevision->id);

        if($imageRevision->exists) { 
            $imageRevision->imageRevisions()->delete();    
            $imageRevision->delete();
        }
    }

    public function testImageRevisionAndImageComment()
    {
        $imageRevision = factory(ImageRevision::class)->create();
    
        $imageComment = factory(ImageComment::class)->create();
        $imageComment->image_revision_id=$imageRevision->id;
        $imageComment->save();
        $pulledImageComment = $imageRevision->imageComments()->first();

        $this->assertEquals($pulledImageComment->id, $imageComment->id);

        if($imageRevision->exists) { 
            $imageRevision->imageComments()->delete();    
            $imageRevision->delete();
        }
    }

    public function testOrderAndFile()
    {
        $imageRevision = factory(ImageRevision::class)->create();
    
        $imageComment = factory(ImageComment::class)->create();
        $imageComment->image_revision_id=$imageRevision->id;
        $imageComment->save();
        $pulledImageComment = $imageRevision->imageComments()->first();

        $this->assertEquals($pulledImageComment->id, $imageComment->id);

        if($imageRevision->exists) { 
            $imageRevision->imageComments()->delete();    
            $imageRevision->delete();
        }
    }

    public function testUserAndFile()
    {
        $user = factory(User::class)->create();
    
        $file = factory(file::class)->create();
        $file->owner_id=$user->id;
        $file->save();
        $pulledFiles = $user->files()->first();

        $this->assertEquals($pulledFiles->id, $file->id);

        if($user->exists) { 
            $user->files()->delete();    
            $user->delete();
        }
    }

    public function testUserAndBrand()
    {
        $user = factory(User::class)->create();
    
        $brand = factory(Brand::class)->create();
        $brand->user_id=$user->id;
        $brand->save();
        $pulledBrands = $user->brands()->first();

        $this->assertEquals($pulledBrands->id, $brand->id);

        if($user->exists) { 
            $user->brands()->delete();    
            $user->delete();
        }
    }

    public function testUserAndOrder()
    {
        $user = factory(User::class)->create();
    
        $order = factory(Order::class)->create();
        $order->owner_id=$user->id;
        $order->save();
        $pulledOrders = $user->orders()->first();

        $this->assertEquals($pulledOrders->id, $order->id);

        if($user->exists) { 
            $user->orders()->delete();    
            $user->delete();
        }
    }

    public function testUserAndNotification()
    {
        $user = factory(User::class)->create();
    
        $notification = factory(FileNotification::class)->create();
        $notification->user_id=$user->id;
        $notification->save();
        $pulledNotifications = $user->notifications()->first();

        $this->assertEquals($pulledNotifications->id, $notification->id);

        if($user->exists) { 
            $user->notifications()->delete();    
            $user->delete();
        }
    }

    public function testUserAndMessage()
    {
        $user = factory(User::class)->create();
    
        $message = factory(Message::class)->create();
        $message->receiver_user_id=$user->id;
        $message->save();
        $pulledMessages = $user->messages()->first();

        $this->assertEquals($pulledMessages->id, $message->id);

        if($user->exists) { 
            $user->messages()->delete();    
            $user->delete();
        }
    }
}
