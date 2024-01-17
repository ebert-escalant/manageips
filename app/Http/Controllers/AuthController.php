<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\User;
use App\Notifications\EmailVerify;
use App\Notifications\PasswordResetNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function register(Request $request): View | RedirectResponse
    {
        if($request->isMethod('post'))
        {
            try
            {
                DB::beginTransaction();

                $errors=[];

				$validator = Validator::make($request->all(), [
					'name' => ['required', 'string', 'max:255'],
					'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
					'password' => ['required', 'confirmed', Rules\Password::defaults()],
				]);

				if ($validator->fails()) {
					$errors = $validator->errors()->all();
				}

                if(count($errors)>0)
                {
                    DB::rollBack();

                    return AppHelper::redirectError($errors, route('register'));
                }

                $user = new User();
                $user->name = trim($request->name);
                $user->email = trim($request->email);
                $user->password = Hash::make($request->password);
                // $user->email_verified_at = null;

                $user->save();

                Auth::login($user);

                DB::commit();

                return AppHelper::redirectSuccess(['Se ha registrado correctamente.'], RouteServiceProvider::HOME);
            }
            catch (\Exception $e)
            {
                DB::rollBack();

                return AppHelper::redirectException(__CLASS__, __FUNCTION__, $e->getMessage(), route('register'));
            }
        }

        return view('auth.register');
    }

    public function login(Request $request): View | RedirectResponse
    {
        if($request->isMethod('post'))
        {
            if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember')))
            {
                $errors[]=trans('auth.failed');

                return AppHelper::redirectError($errors, route('login'));
            }

            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return view('auth.login');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}