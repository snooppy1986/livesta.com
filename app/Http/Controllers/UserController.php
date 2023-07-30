<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\PasswordController;
use App\Models\User;
use App\Models\UserAttribute;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Nette\Schema\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;
use function Illuminate\Validation\message;

class UserController extends Controller
{
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'=>'min: 3 | max: 255 | string',
            'surname'=>'min: 3 | max: 255 | string',
            'phone'=>'numeric | digits:10',
            'email' => 'string|email|max:255|unique:'.User::class.',id,'.$request->user_id,
            'notes'=>'max: 1024'
        ]);

        /*$user = User::where('id', $request->user_id)->first();*/
        if($user){
            //update user data
            $user->update($data);
            //update user avatar
            if($request->avatar){
                if($user->avatar !== 'user_avatar.jpg'){
                    Storage::disk('public')->delete('images/'.$user->avatar);
                }

                $file = $request->avatar[0];
                $name = md5(Carbon::now().'_'.$file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
                /*$path = Storage::disk('public')->putFileAs('images', $file, $name);*/
                Image::make($file)
                    ->fit(50, 50)
                    ->save(storage_path('app/public/images/'. $name))
                ;
                $user->update([
                    'avatar'=>$name,
                    'avatar_url' => url('/storage/images/'. $name)
                ]);
            }
            if(!$request->avatar && $request->remove_image){
                if($user->avatar !== 'user_avatar.jpg'){
                    Storage::disk('public')->delete('images/'.$user->avatar);
                }
                $user->update([
                    'avatar'=>'user_avatar.jpg',
                    'avatar_url' => url('/storage/images/'. 'user_avatar.jpg')
                ]);
            }

            return response()->json(['message'=>'Особисті дані змінено успішно']);
        }

        return response()->json(['message'=>'Особисті дані не змінено. Спробуйте пізніше.']);
    }

    public function getAuthUser(Request $request)
    {
        /*$token = $request->bearerToken();*/
        $token =JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $address = $user->userAttributes;
        /*$size = Storage::disk('public')->size('images/'.$user->avatar);*/

        return response()->json([
            'user'=>$user,
            'orders' => $user->orders,
            'address' => $address,
            'size' => 300
        ]);
    }

    public function storeAttributes(Request $request)
    {
        $data= $request->validate([
            'user_id'=>'integer',
            'area'=>'max: 255 | string',
            'city'=>'max: 255 | string',
            'street'=>'max: 255 | string',
            'house_number'=>' max: 255 | string',
            'postcode'=>'integer'
        ]);
        /*dd($data);*/
        $address = UserAttribute::where('user_id', $data['user_id'])->first();
        if($address)
            $address->update($data);
        else UserAttribute:: create($data);
        /*UserAttributes::updateOrCreate(
            ['user_id'=>$data['user_id']],
            ['area'=>$data['area']],
            ['city'=>$data['city']],
            ['street'=>$data['street']],
            ['house_number'=>$data['house_number']],
            ['postcode'=>$data['postcode']]
        );*/
        return response()->json(['message'=>'Адресу змінено успішно']);
    }
}
