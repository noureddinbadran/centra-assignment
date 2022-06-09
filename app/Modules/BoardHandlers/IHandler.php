<?php

namespace App\Modules\BoardHandlers;

interface IHandler
{
    /**
     * Each app should implement the suitable business logic to handle its own board
     * for example(github board / trello board / Jira Board .. and so)
     * @return mixed
     */
    public function handle();
}