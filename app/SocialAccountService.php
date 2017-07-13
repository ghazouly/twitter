<?php

namespace App;

use Laravel\Socialite\Contracts\User as SocialNetworkUser;

class SocialAccountService
{
    public function createOrGetUser(SocialNetworkUser $socialNetworkUser)
    {
        $account = SocialAccount::whereSocialNetwork('facebook')
            ->whereSocialNetworkUserId($socialNetworkUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'social_network_user_id' => $socialNetworkUser->getId(),
                'social_network' => 'facebook'
            ]);

            $user = User::whereEmail($socialNetworkUser->getEmail())->first();

            if (!$user) {

              $username = str_replace(' ', '', $socialNetworkUser->getName());
              $user = User::create([
                  'email' => $socialNetworkUser->getEmail(),
                  'name' => $socialNetworkUser->getName(),
                  'username' => $username,
                  'password' => bcrypt($username)
              ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}
