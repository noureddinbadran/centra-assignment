<?php

namespace App\Modules\BoardHandlers\Github;

use App\Modules\BoardHandlers\IHandler;
use App\Modules\Clients\Github\Client;
use App\Modules\Translators\Github\GithubTranslator;
use Illuminate\Support\Facades\Log;

/**
 * Class GithubHandler
 * This class is responsible for handling the github-board and retrieving the data of its milestones and issues
 * @package App\Modules\BoardHandlers\Github
 */
final class GithubHandler implements IHandler
{
    public function __construct(private Client $githubClient) { }

    /**
     * Getting the information of the board's milestones which they are related to the given repositories
     * @return array
     */
    public function handle() : array
    {
        try {
            $repositories = explode('|', config('services.github.repositories'));

            $repos = [];
            foreach ($repositories as $repository) {
                $milestones = $this->githubClient->getMilestones($repository);
                foreach ($milestones as $milestone) {
                    $repos[$repository][$milestone['title']] = $milestone;
                }
            }

            ksort($repos);

            // translate the result set
            $githubTranslator = app()->make(GithubTranslator::class, ['githubClient' => $this->githubClient, 'repositories' => $repos]);
            return $githubTranslator->translate();

        } catch (\Throwable $e)
        {
            dd($e->getMessage());
            Log::error((string)$e);
        }
    }
}