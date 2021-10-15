<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Game extends Model
{


    protected $fillable = [
        'player_name',
        'player_steps',
        'levels',
        'path',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function (Game $game) {
            $game->generateUuid();
            $game->generatePath();
        });
    }

    public function __construct(string $player_name, int $levels)
    {
        parent::__construct();
        $this->player_name = $player_name;
        $this->levels = $levels;
    }

    public function generateUuid(){
        $this->uuid = Str::uuid();

    }

    private function generatePath() {
        $input = 'ABC';
        $strength = $this->levels;

        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        $this->path = $random_string;
    }
}
