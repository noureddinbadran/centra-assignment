<?php

namespace App\Http\Controllers;

use App\Modules\BoardHandlers\Github\GithubHandler;
use Illuminate\Routing\Controller as BaseController;

class BoardController extends BaseController
{
    public function getBoardDetails()
    {
        $githubHandler = app()->make(GithubHandler::class);
        $data = $githubHandler->handle();

        return view('board.github.index', [
            'repositories' => $data
        ]);
    }
}