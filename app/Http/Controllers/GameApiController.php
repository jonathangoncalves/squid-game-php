<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use App\Http\Resources\GameResource;
use App\Models\Game;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;

class GameApiController extends Controller
{
    /**
     * @param GameRequest $request
     */
    public function createGame(GameRequest $request)
    {
        try {
            $game = new Game();
            $game->player_name = $request->post('player_name');

            $setting = Setting::where('name', 'levels')->first();
            $game->levels = $setting->value;
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

    public function getGames()
    {
        try {
            $games = Game::whereNotNull('status')->orderBy('status', 'desc')->orderBy('score', 'desc')->limit(5)->get();
        } catch (\Exception $e) {
            return response()->json(["error" => true, "message" => $e->getMessage()], 400);
        }
        return GameResource::collection($games);
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
