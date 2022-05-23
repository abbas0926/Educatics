<?php
namespace App\Traits;

use Illuminate\Support\Facades\Route;
use Str;
trait Sluggify {

    public static function booted(){
        static::creating(function($model){
            $model->slug= static::makeSlug($model->title);
        });
        
    }  

    public static function makeSlug($str){
        $slug=Str::slug($str);
        //check uniqueness!
        while(static::where('slug',$slug)->get()->count() >0){
            $slug=Str::slug($str.rand(1,1000));
        }
        return $slug;
        
    }
    public function getRouteKeyName(){
        
        return 'slug';
    }     


}
