<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;
use App\Models\Enemy;
use App\Models\Item;
use App\Http\Controllers\BSController;

class APIController extends Controller
{
    public function index(){
        $res = [
            'status' => 'ok',
            'message' => 'La API funciona correctamente'
        ];
        return response()->json($res, 200);
    }
    public function getAllHeroes(){
        $heroes =  Hero::all();
        $res = [
            'status' => 'ok',
            'message' => 'Lista de Heroes',
            'data' => $heroes
        ];
        return response()->json($res, 200);
    }
    public function getHeroe($id){
        $hero =  Hero::find($id);

        if(isset($hero)){
            $res = [
                'status' => 'ok',
                'message' => 'Obtener Heroe ' . $hero->name,
                'data' => $hero
            ];            
        }else{
            $res = [
                'status' => 'error',
                'message' => 'No se encontró el Heroe'
            ];            
        }
        return response()->json($res, 200);
    }
    public function getAllEnemies(){
        $enemies =  Enemy::all();
        $res = [
            'status' => 'ok',
            'message' => 'Lista de Enemigos',
            'data' => $enemies
        ];
        return response()->json($res, 200);
    }
    public function getEnemy($id){
        $enemy =  Enemy::find($id);

        if(isset($enemy)){
            $res = [
                'status' => 'ok',
                'message' => 'Obtener Enemigo '. $enemy->name,
                'data' => $enemy
            ];            
        }else{
            $res = [
                'status' => 'error',
                'message' => 'No se encontró el Enemigo'
            ];            
        }
        return response()->json($res, 200);        
    }
    public function getAllItems(){
        $items =  Item::all();
        $res = [
            'status' => 'ok',
            'message' => 'Lista de Items',
            'data' => $items
        ];
        return response()->json($res, 200);
    }
    public function getItem($id){
        $item =  Item::find($id);

        if(isset($item)){
            $res = [
                'status' => 'ok',
                'message' => 'Obtener Item ' . $item->name,
                'data' => $item
            ];            
        }else{
            $res = [
                'status' => 'error',
                'message' => 'No se encontró el Item'
            ];            
        }
        return response()->json($res, 200);        
    }

    public function runManualBS($heroId, $enemyId){
        $bs = BSController::runAutoBattle($heroId, $enemyId);
        
        $res=[
            'status' => 'ok',
            'message' => 'Sistema de batalla entre'. $bs['heroName'].' y '. $bs['enemyName'],
            'data' => $bs
        ];
        return response()->json($res, 200);    
    }
}
