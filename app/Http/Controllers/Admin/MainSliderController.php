<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainSliderStoreRequest;
use App\Http\Requests\MainSliderUpdateRequest;
use App\Models\MainSlider;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\Facades\Image as ImageAlias;


class MainSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides = MainSlider::all()->sortByDesc('status');

        return view('admin.options.mainSlider.main_slider', [
            'slides'=>$slides
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::get();
        return view('admin.options.mainSlider.create', [
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MainSliderStoreRequest $request)
    {
        $data = $request->all();
        //upload image
        $file_ext = $data['image']->getClientOriginalExtension();
        $file_name = md5(now().$data['image']->getClientOriginalName()).'.'.$file_ext;
        $data['image_link'] = url('storage/images/main_slider/'.$file_name);
        Image::make($data['image'])
            ->fit(841, 842)
            ->save(Storage::path('public/images/main_slider/').$file_name);

        //store slider

        MainSlider::create($data);

        return redirect()->route('option.main-slider')->with('message', 'Слайд створено успішно');
    }

    /**
     * Display the specified resource.
     */
    public function show(MainSlider $mainSlider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MainSlider $slide)
    {
        $products = Product::get();
        return view('admin.options.mainSlider.edit', [
            'products'=>$products,
            'slide'=>$slide
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MainSliderUpdateRequest $request, MainSlider $slide)
    {
        $data = $request->all();

        if(isset($data['image'])){
            //delete old file
            $remove_file_name = strrchr($slide->image_link, '/');
            Storage::delete('public/images/main_slider'.$remove_file_name);

            //upload new file
            $file_ext = $data['image']->getClientOriginalExtension();
            $file_name = md5(now().$data['image']->getClientOriginalName()).'.'.$file_ext;
            Image::make($data['image'])
                ->fit(841, 842)
                ->save(Storage::path('public/images/main_slider/').$file_name);

            //update slide image
            $slide->update([
                'image_link'=>url('storage/images/main_slider/'.$file_name)
            ]);
        }
        //update slide
        $slide->update($data);

        return redirect()->route('option.main-slider')->with(['message'=>'Слайд відредагований']);
    }

    public function updateStatus(MainSlider $slide, Request $request){
        $status = $request->status;
        $message = '';
        if($status=='true'){
            $slide->update([
                'status'=>1
            ]);
            $message='Слайд активовано';
        }
        else {
            $slide->update([
                'status'=>0
            ]);
            $message='Слайд деактивовано';
        }

        return response()->json($message);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MainSlider $slide)
    {
        //delete image file
        $remove_file_name = strrchr($slide->image_link, '/');
        Storage::delete('public/images/main_slider'.$remove_file_name);

        //delete slide
        $slide->delete();

        return response()->json('Слайд видалено.');
    }
}
