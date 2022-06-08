<?php

namespace App\Modules\Clients\Github;

use App\Modules\AuthProviders\GithubAuthProvider;
use Github\AuthMethod;
use Github\Client as GithubClient;
use App\Modules\Clients\BaseAppClient;

class Client extends BaseAppClient
{
    public function __construct(private GithubAuthProvider $authProvicer, private GithubClient $client)
    {
        $this->client->authenticate($authProvicer->getAccessToken(), AuthMethod::ACCESS_TOKEN);
    }

    public function getMilestones()
    {
        return $this->client->api('issues')->milestones()->all(config('services.github.account'), config('services.github.repositories'));
    }

    public function getIssues($milestone_number)
    {
        return $this->client->api('issues')->all(config('services.github.account'), config('services.github.repositories', [
            'milestone' => $milestone_number,
            'state' => 'all',
        ]));
    }

}
