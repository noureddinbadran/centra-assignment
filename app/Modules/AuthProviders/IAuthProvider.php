<?php

namespace App\Modules\AuthProviders;

/**
 * Each provider should implement this interface to write the suitable business logic to get the access token
 * Interface IAuthProvider
 * @package App\Modules\AuthProviders\
 */
interface IAuthProvider
{
    /**
     * Each provider should implement this method and perform its suitable business logic to get the access token
     * @return mixed
     */
    public function getAccessToken();
}