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
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function (Game $game) {
            $game->generateUuid();
            $game->generatePath();
            $game->score = 0;
            $game->player_steps = '';
        });
    }


    public function generateUuid()
    {
        $this->uuid = Str::uuid();

    }

    private function generatePath()
    {
        $input = 'ABC';
        $strength = $this->levels;

        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        $this->path = $random_string;
    }

    /**
     * @param string $step
     */
    public function makeStep(string $step){
        if(
            strlen($step) !== 1 ||
            strpos('ABC', $step) === false
        ){
            throw new \InvalidArgumentException("Invalid Step option");
        }
        if(!is_null($this->status)){
            if($this->status){
                throw new \InvalidArgumentException("Player already won the game");
            }
            throw new \InvalidArgumentException("Player already lose the game");
        }
        $current_steps = $this->player_steps;
        $this->player_steps .= $step;
        if($step !== substr($this->path, strlen($current_steps), 1)){
            $this->status = false;
        }elseif(strlen($this->player_steps) === (int)$this->levels){
            $this->status = true;
            $this->score++;
        }else{
            $this->score++;
        }

        $this->save();
    }
}
