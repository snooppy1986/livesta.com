<?php

namespace App\Observers;


use App\Models\MainSlider;
use Illuminate\Support\Facades\Cache;

class MainSliderObserver
{
    /**
     * Handle the MainSlider "created" event.
     */
    public function created(MainSlider $mainSlider): void
    {
        //create cache slide
        Cache::put('main_sliders:'.$mainSlider->id, $mainSlider);
        //update cache list sliders
        Cache::forget('main_sliders:all');
        Cache::rememberForever('main_sliders:all', function (){
            return MainSlider::all()->sortByDesc('status');
        });
    }

    /**
     * Handle the MainSlider "updated" event.
     */
    public function updated(MainSlider $mainSlider): void
    {
        //delete cache slide
        Cache::forget('main_sliders:'.$mainSlider->id);
        //create cache slide
        Cache::put('main_sliders:'.$mainSlider->id, $mainSlider);
        //update cache list sliders
        Cache::forget('main_sliders:all');
        Cache::rememberForever('main_sliders:all', function (){
            return MainSlider::all()->sortByDesc('status');
        });
    }

    /**
     * Handle the MainSlider "deleted" event.
     */
    public function deleted(MainSlider $mainSlider): void
    {
        //delete cache slide
        Cache::forget('main_sliders:'.$mainSlider->id);
        //update cache list sliders
        Cache::forget('main_sliders:all');
        Cache::rememberForever('main_sliders:all', function (){
            return MainSlider::all()->sortByDesc('status');
        });
    }

}
