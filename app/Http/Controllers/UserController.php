<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\Traits\UploadFile;
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
    use UploadFile;
    public function update(UserUpdateRequest $request, User $user)
    {

        $data = $request->validated();

        if($user){
            //update user avatar
            if($data['image'] !== 'null'){

                if($user->avatar !== 'user_avatar.jpg'){
                    Storage::disk('public')->delete('images/avatar/'.$user->avatar);
                }

                //uploag avatar
                $fileName = $this->UploadFile($data['image'], 50, 50, 'public/images/avatar/');
                $data['avatar'] = $fileName;
                $data['avatar_url'] = url('/storage/images/avatar/'. $fileName);
            }

            if($data['image'] == 'null' && $data['remove_image']){
                if($user->avatar !== 'user_avatar.jpg'){
                    Storage::disk('public')->delete('images/avatar/'.$user->avatar);
                }

                $data['avatar'] = 'user_avatar.jpg';
                $data['avatar_url'] = url('/storage/images/avatar/user_avatar.jpg');

            }

            //update user data
            $user->update($data);

            return response()->json(['message'=>'Особисті дані змінено успішно']);
        }

        return response()->json(['message'=>'Особисті дані не змінено. Спробуйте пізніше.']);
    }

    public function getAuthUser(Request $request)
    {
        $token =JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        /*$size = Storage::disk('public')->size('images/'.$user->avatar);*/

        return response()->json([
            'user'=>new UserResource($user),
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

        $address = UserAttribute::where('user_id', $data['user_id'])->first();
        if($address)
            $address->update($data);
        else UserAttribute:: create($data);

        return response()->json(['message'=>'Адресу змінено успішно']);
    }
}
