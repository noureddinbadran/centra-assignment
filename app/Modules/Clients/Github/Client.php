<?php

namespace App\Modules\Clients\Github;

use App\Modules\AuthProviders\GithubAuthProvider;
use App\Modules\Traits\GithubTrait;
use Github\Client as GithubClient;
use App\Modules\Clients\BaseAppClient;
use Michelf\Markdown;

/**
 * Class Client
 * This class is responsible for getting the data from github
 * @package App\Modules\Clients\Github
 */
final class Client extends BaseAppClient
{
    use GithubTrait;

    public function __construct(private GithubAuthProvider $authProvicer, private GithubClient $client)
    {
        // in case we need to authenticate with github in the future, only we should uncomment this
        //$this->client->authenticate($authProvicer->getAccessToken(), 'access_token_header');
    }


    /**
     * Fetching all milestones
     * @param $repository
     * @return array
     */
    public function getMilestones($repository) : array
    {
        return $this->client->api('issues')->milestones()->all(config('services.github.account'), $repository);
    }

    /**
     * Fetching all issues related to a specific milestones
     * @param $repository
     * @param $milestone_number
     * @return array
     */
    public function getIssues($repository, $milestone_number) : array
    {
        return $this->client->api('issues')->all(config('services.github.account'), $repository, [
            'milestone' => $milestone_number,
            'state' => 'all',
        ]);
    }

    /**
     * @param $repository
     * @param $milestone_number
     * @return array
     */
    public function getIssuesDetails($repository, $milestone_number) : array
    {
        $i = $this->getIssues($repository, $milestone_number);

        foreach ($i as $ii)
        {
            if (isset($ii['pull_request']))
                continue;
            $issues[$ii['state'] === 'closed' ? 'completed' : (($ii['assignee']) ? 'active' : 'queued')][] = array(
                'id' => $ii['id'], 'number' => $ii['number'],
                'title'            	=> $ii['title'],
                'body'             	=> Markdown::defaultTransform($ii['body']),
                'url' => $ii['html_url'],
                'assignee'         	=> (is_array($ii) && array_key_exists('assignee', $ii) && !empty($ii['assignee'])) ? $ii['assignee']['avatar_url'].'?s=16' : NULL,
                'paused'			=> $this->labels_match($ii, [
                    'waiting-for-feedback'
                ]),
                'progress'			=> $this->_percent(
                    substr_count(strtolower($ii['body']), '[x]'),
                    substr_count(strtolower($ii['body']), '[ ]')),
                'closed'			=> $ii['closed_at']
            );
        }
        usort($issues['active'], function ($a, $b) {
            return count($a['paused']) - count($b['paused']) === 0 ? strcmp($a['title'], $b['title']) : count($a['paused']) - count($b['paused']);
        });

        return $issues;
    }


}
