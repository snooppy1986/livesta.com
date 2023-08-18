<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainSlider\MainSliderStoreRequest;
use App\Http\Requests\MainSlider\MainSliderUpdateRequest;
use App\Http\Resources\MainSlider\MainSliderCollection;
use App\Http\Resources\MainSlider\MainSliderResource;
use App\Models\MainSlider;
use App\Models\Product;
use App\Models\Traits\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class MainSliderController extends Controller
{
    use UploadFile;

    public function index()
    {
        $slides = MainSlider::all()->sortByDesc('status');

        return view('admin.options.mainSlider.main_slider')
            ->with(['slides'=>(new MainSliderCollection($slides))->resolve()]);
    }

    public function create()
    {
        $products = Product::get(['id', 'title']);

        return view('admin.options.mainSlider.create', [
            'products' => $products
        ]);
    }

    public function store(MainSliderStoreRequest $request)
    {
        $data = $request->validated();

        //upload image
        $data['image_link'] = url(
            '/storage/images/main_slider/'.$this->UploadFile($data['image'], 841, 842, 'public/images/main_slider/'));

        //store slider
        MainSlider::create($data);

        return redirect()->route('option.main-slider')->with('message', 'Слайд створено успішно');
    }

    public function edit(MainSlider $slide)
    {
        $products = Product::get();
        return view('admin.options.mainSlider.edit')
            ->with([
                'products'=>$products,
                'slide'=> (new MainSliderResource($slide))->resolve()
            ]);
    }


    public function update(MainSliderUpdateRequest $request, MainSlider $slide)
    {
        $data = $request->validated();

        if(isset($data['image'])){
            //delete old file
            $remove_file_name = $slide['image_link'];
            Storage::delete('public/images/main_slider/'.$remove_file_name);

            //upload new file
            $data['image_link'] = url(
                '/storage/images/main_slider/'.$this->UploadFile($data['image'], 841, 842, 'public/images/main_slider/'));

        }
        //update slide
        $slide->update($data);

        return redirect()
            ->route('option.main-slider')
            ->with(['message'=>'Слайд відредагований']);
    }

    public function updateStatus(MainSlider $slide, Request $request){
        $status = $request->status;
        $message = $status=='true' ? 'Слайд активовано' : 'Слайд деактивовано';
        if($status=='true'){
            $slide->update([
                'status' => 1
            ]);
        }
        else {
            $slide->update([
                'status' => 0
            ]);
        }

        return response()->json($message);
    }

    public function destroy(MainSlider $slide)
    {
        //delete image file
        $remove_file_name = $slide->image_link;
        Storage::delete('public/images/main_slider/'.$remove_file_name);

        //delete slide
        $slide->delete();

        return response()->json('Слайд видалено.');
    }
}
