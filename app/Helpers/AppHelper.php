<?php
namespace App\Helpers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class AppHelper
{
    public static function redirectSuccess($messages,$route): RedirectResponse
    {
        Session::flash('globalMessage', $messages);
        Session::flash('type', 'success');

        return redirect($route);
    }

    public static function redirectInfo($messages, $route): RedirectResponse
	{
		Session::flash('globalMessage', $messages);
		Session::flash('type', 'notice');

		return redirect($route);
	}

	public static function redirectError($messages, $route): RedirectResponse
	{
		Session::flash('globalMessage', $messages);
		Session::flash('type', 'error');

		return redirect($route);
	}

	public static function redirectException($controller, $method, $error, $route): RedirectResponse
	{
		Session::flash('globalMessage', ['Se ha producido un error inesperado, por favor, inténtelo de nuevo más tarde.']);
		Session::flash('type', 'exception');

		return redirect($route);
	}
}
