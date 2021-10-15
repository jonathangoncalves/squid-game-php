<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use App\Http\Resources\GameResource;
use App\Models\Game;

class GameController extends Controller
{
    /**
     * @param GameRequest $request
     * @return GameResource
     */
    public function createGame(GameRequest $request): GameResource
    {
        $game = new Game($request->post('player_name'), $request->post('level'));
        $game->save();
        return new GameResource($game);
    }
}
