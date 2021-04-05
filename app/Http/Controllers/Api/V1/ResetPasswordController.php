<?php


namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Notifications\ResetPasswordRequest;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    /**
     * Create token password reset.
     *
     * @param  ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function sendMail(Request $request)
    {
        $rules = [
            'email' => 'required|exists:users,email',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            $errors = (new ValidationException($validator))->errors();
            return response_validation_error($rules, $errors, __('messages.email_not_true'));
        }
        $user = User::where('email', $request->email)->firstOrFail();
        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $user->email,
        ], [
            'token' => Str::random(60),
        ]);
        if ($passwordReset) {
            $user->notify(new ResetPasswordRequest($passwordReset->token));
        }
        return res_success([], __('messages.sent_mail'));
    }

    public function reset(Request $request, $token)
    {
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($passwordReset->created_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 422);
        }
        $user = User::where('email', $passwordReset->email)->firstOrFail();
        $password = bcrypt($request->password);
        $updatePasswordUser = $user->update(['password' => $password]);
        $passwordReset->delete();

        return res_success(['success' => $updatePasswordUser], __('messages.reset_password_success'));
    }
}
