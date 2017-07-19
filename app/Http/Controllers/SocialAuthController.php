<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Socialite;
use App\SocialAccountService;

class SocialAuthController extends Controller
{
    public function redirect()
    {
      return Socialite::driver('facebook')->redirect();
    }

  public function callback(\App\SocialAccountService $service)
  {
    // when facebook call us a with token
    $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
    auth()->login($user);

    return redirect()->to('/home');

  }


}
