<?php

namespace App\Modules\AuthProviders;

use Illuminate\Http\RedirectResponse;
use League\OAuth2\Client\Provider\Github;

final class GithubAuthProvider implements IAuthProvider
{
    public function __construct(private Github $github) {}

    public function getAccessToken()
    {
        if (\request()->get('code') === null) {
            $redirectUrl = $this->github->getAuthorizationUrl();

            $response = new RedirectResponse($redirectUrl);
            $response->send();
        }
        else
        {
            return $this->github->getAccessToken('authorization_code', [
                'code' => \request()->get('code'),
            ]);
        }
    }
}