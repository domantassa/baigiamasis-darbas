<?php

namespace Tests\Unit;

use App\brand;


use App\BrandFile;
use App\BrandColor;


use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrandTest extends TestCase
{

    public function testBrandCreation()
    {
        $brand = factory(Brand::class)->create();
        $brand = Brand::orderBy('id', 'desc')->first();

        $brandDoesExists=false;
        if($brand->exists) {
            $brandDoesExists = true;
        }
        
        $this->assertTrue($brandDoesExists);

        if($brand->exists) {
            $brand->delete();
        }
    }

    public function testBrandDeletion()
    {
        $brand = factory(brand::class)->create();
        $brand = brand::orderBy('id', 'desc')->first();
        if($brand) {
            $brand->delete();
        }
        $brandDoesNotExists=true;
        if($brand->exists) {
            $brandDoesNotExists = false;
        }
        $this->assertTrue($brandDoesNotExists);
    }

    public function testBrandUpdate()
    {
        $brand = factory(brand::class)->create();
        $this->assertEquals($brand->website, 'www.example.com');

        $brand->website = 'new website';
        $brand->save();
        
        $this->assertEquals($brand->website, 'new website');
    
        if($brand->exists) {
            $brand->delete();
        }
    }
    
}
