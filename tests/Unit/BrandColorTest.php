<?php

namespace Tests\Unit;

use App\BrandColor;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrandColorTest extends TestCase
{

    public function testBrandColorCreation()
    {
        $brandColor = factory(BrandColor::class)->create();
        $brandColor = BrandColor::orderBy('id', 'desc')->first();

        $brandColorDoesExists=false;
        if($brandColor->exists) {
            $brandColorDoesExists = true;
        }
        $this->assertTrue($brandColorDoesExists);
        
    }

    public function testBrandColorDeletion()
    {
        $brandColor = factory(BrandColor::class)->create();
        $brandColor = BrandColor::orderBy('id', 'desc')->first();
        if($brandColor) {
            $brandColor->delete();
            
        }
        $brandColorDoesNotExists=true;
        if($brandColor->exists) {
            $brandColorDoesNotExists = false;
        }
        $this->assertTrue($brandColorDoesNotExists);
        
    }

    public function testBrandColorUpdate()
    {
        $brandColor = factory(BrandColor::class)->create();
        $brandColor = BrandColor::orderBy('id', 'desc')->first();
        $this->assertEquals($brandColor->color_code, 'FFFFFF');

        $brandColor->color_code = 'FFF000';
        $brandColor->save();
        
        $this->assertEquals($brandColor->color_code, 'FFF000');
    
        if($brandColor->exists) {
            $brandColor->delete();
        }
    }
}