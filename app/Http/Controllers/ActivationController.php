<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivateYourAccount;

class ActivationController extends Controller
{
    //activate your account
    public function activateUserAccount($code)
    {
    	$user = User::whereCode($code)->first();
    	$user->code = null;
    	$user->update([
    		"active" => 1
    	]);
    	Auth::login($user);
    	return redirect("/")->withSuccess("connecté");
    }

    //send email to activate user account
    public function resendActivationCode($email)
    {
    	$user = User::whereEmail($email)->first();
    	if ($user->active) 
    	{
    		return redirect("/");
    	}
    	$user->code = null;
    	$user->update([
    		"active" => 1
    	]);
    	Mail::to($user)->send(new ActivateYourAccount($user->code));
    	return redirect("/login")->withSuccess("le lien d'activation est envoyé");
    }
}
