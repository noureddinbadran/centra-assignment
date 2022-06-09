<?php

namespace App\Modules\AuthProviders;

use Illuminate\Http\RedirectResponse;
use League\OAuth2\Client\Provider\Github;

/**
 * Class GithubAuthProvider
 * This class is responsible for authenticating with github
 * @package App\Modules\AuthProviders
 */
final class GithubAuthProvider implements IAuthProvider
{
    public function __construct(private Github $github) {}

    /**
     * Authenticate with github and git the access token
     * @return mixed
     */
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