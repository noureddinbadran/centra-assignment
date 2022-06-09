<?php

namespace App\Modules\Translators\Github;

use App\Modules\Traits\GithubTrait;

/**
 * Class GithubTranslator
 * This class is responsible for translating the information of the github-board to be in a proper format for previewing
 * @package App\Modules\Translators\Github
 */
final class GithubTranslator
{
    use GithubTrait;

    public function __construct(private $githubClient, private $repositories) { }

    /**
     * Translating the information of the github-board
     * @return array
     */
    public function translate() : array
    {
        foreach ($this->repositories as $repo => $milestones) {
            foreach ($milestones as $milestone => $data) {
                $issues = $this->githubClient->getIssuesDetails($repo, $data['number']);

                $percent = $this->_percent($data['closed_issues'], $data['open_issues']);
                if ($percent) {
                    $this->repositories[$repo][$milestone] = array_merge($this->repositories[$repo][$milestone], [
                        'milestone' => $milestone,
                        'url' => $data['html_url'],
                        'progress' => $percent,
                        'queued' => $issues['queued'] ?? [],
                        'active' => $issues['active'] ?? [],
                        'completed' => $issues['completed'] ?? []
                    ]);
                }
            }
        }
        return $this->repositories;
    }
}