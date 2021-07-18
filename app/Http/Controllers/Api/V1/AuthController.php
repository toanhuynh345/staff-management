<?php


namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        $loginData = $request->only(['email', 'password']);
        if (!auth()->attempt($loginData)) {
            return res_error(__('messages.invalid_credentails'));
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        $response = [
            'user' => auth()->user(),
            'access_token' => $accessToken
        ];
        return res_success($response);
    }

    public function logout() {
        $token = auth()->user()->token();
        if ($token) {
            $token->revoke();
            return res_success([], __('messages.logout_success'));
        }
        return res_error(__('messages.unauthorized'));
    }

    public function getProfile() {
        $user = auth()->user();
        if ($user) {
            $response = [
                'user' => $user
            ];
            return res_success($response);
        }
        return res_error(__('messages.unauthorized'));
    }

    public function updateProfile(ProfileRequest $request) {
        try {
            $user = auth()->user();
            $user->name = $request->name;
            $user->sex = $request->sex;
            $user->description = $request->description;
            $user->birthday = $request->birthday;
            if ($request->file('avatar')){
                $image = $request->file('avatar');
                $name = $image->getClientOriginalName();
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $name);
                $user->avatar = '/images/'.$name;
            }
            $user->save();
            $response = [
                'user' => $user
            ];
            return res_success($response, __('messages.update_profile_success'));
        } catch (\Exception $e) {
            return res_error($e->getMessage());
        }
    }

    public function changePassword(Request $request) {
        $rules = [
            'old_password' => 'required|password:api',
            'new_password' => 'required|confirmed',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            $errors = (new ValidationException($validator))->errors();
            return response_validation_error($rules, $errors, __('messages.change_password_failed'));
        }
        $user = auth()->user();
        $user->password = bcrypt($request->new_password);
        $user->save();
        $token = auth()->user()->token();
        if ($token) {
            $token->revoke();
        }
        return res_success([], __('messages.change_password_success'));
    }

}
