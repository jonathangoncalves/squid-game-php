<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    /**
     * @param GameRequest $request
     */
    public function createGame(GameRequest $request)
    {
        try {
            $game = new Game();
            $game->player_name = $request->post('player_name');
            $game->levels = $request->post('levels');
            $game->save();
        } catch (\Exception $e) {
            return response()->json(["error" => true, "message" => $e->getMessage()], 400);
        }
        return new GameResource($game);
    }

    public function getGame(string $game_uuid)
    {
        try {
            $game = Game::where('uuid', $game_uuid)->firstOrFail();
        } catch (\Exception $e) {
            return response()->json(["error" => true, "message" => $e->getMessage()], 400);
        }
        return new GameResource($game);
    }

    public function makeStep(string $game_uuid, string $step)
    {
        try {
            $game = Game::where('uuid', $game_uuid)->firstOrFail();
            $game->makeStep($step);
        } catch (\Exception $e) {
            return response()->json(["error" => true, "message" => $e->getMessage()], 400);
        }
        return new GameResource($game);
    }
}
