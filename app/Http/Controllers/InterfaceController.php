<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Setting;
use Illuminate\Http\Request;

class InterfaceController extends Controller
{
    public function index(){
        return view('interface');
    }

    public function game(string $game_uuid){
        try {
            $game = Game::where('uuid', $game_uuid)->firstOrFail();
        }catch(\Exception $e){
            return redirect('/?fail');
        }

        return view('game', compact('game'));
    }

    public function getSettings(){
        $settings = Setting::get();
        return view('settings', compact('settings'));
    }

    public function storeSettings(Request $request){
        foreach($request->all() as $setting_name =>  $setting_value){
            $setting = Setting::where('name', $setting_name)->first();
            $setting->value = $setting_value;
            $setting->save();
        }
        return redirect('/settings');
    }
}
