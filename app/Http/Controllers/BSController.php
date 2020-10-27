<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;
use App\Models\Enemy;

class BSController extends Controller
{
    public function index(){ 
        //dd($this->runManualBattle(5,3));     
        return view('admin.bs.index', $this->runAutoBattle(5,3));
    }
    // se hizo el metodo estático para que se pueda invocar desde el APIController
    public static function runAutoBattle($heroId, $enemyId){
        $hero = Hero::find($heroId);
        $enemy = Enemy::find($enemyId);
        $events=[];
       // dd($hero->xp);

        while($hero->hp > 0 && $enemy->hp > 0){
            $luck = random_int(0,100);

            if ($luck >= $hero->luck){// heroe le pega al enemigo
                $hp = $enemy->def - $hero->atq;
                if ($hp < 0){
                    $enemy->hp -= $hp * -1; // para que siempre sea positivo
                }
                if ($enemy->hp > 0){ // si el enemigo sigue vivo
                    $ev = [
                        'winner' => 'hero',
                        'text' => $hero->name . ' hizo un daño de '.$hero->atq.' a '. $enemy->name
                    ];
                }else{ // si el enemigo muere
                    $ev = [
                        'winner' => 'hero',
                        'text' => $hero->name . ' acabó con la vida de '. $enemy->name . ' y ganó '. $enemy->xp. ' de experiencia.'
                    ];

                    $hero->xp = $hero->xp + $enemy->xp;
                    if ($hero->xp >= $hero->level->xp){
                        $hero->xp = 0; 
                        $hero->level_id += 1; 
                    }
                    $hero->save();

                }               
            }else{ // el enemigo le pega al heroe
                $hp = $hero->def - $enemy->atq;
                if ($hp < 0){
                    $hero->hp -= $hp * -1;
                }
                if ($hero->hp > 0){ 
                    $ev = [
                        'winner' => 'enemy',
                        'text' => $hero->name . ' recibió un daño de '.$enemy->atq.' por '. $enemy->name
                    ];
                }else{  // el hero esta muerto
                    $ev = [
                        'winner' => 'enemy',
                        'text' => $hero->name . ' fue asesinado por '. $enemy->name
                    ];
                }                                
            }
            array_push($events, $ev);
        }
        return [
            'events' => $events,
            'heroName' => $hero->name,
            'enemyName' => $enemy->name,
            'heroAvatar' => $hero->img_path,
            'enemyAvatar' => $enemy->img_path
        ];
    }
    public function runManualBattle($heroId, $enemyId){
        $hero = Hero::find($heroId);
        $enemy = Enemy::find($enemyId);
        $luck = random_int(0,100);
        
        if ($luck >= $hero->luck){// heroe le pega al enemigo
            $hp = $enemy->def - $hero->atq;
            if ($hp < 0){
                $enemy->hp -= $hp * -1; // para que siempre sea positivo
            }
            if ($enemy->hp > 0){ // si el enemigo sigue vivo
                return [
                    'winner' => 'hero',
                    'text' => $hero->name . ' hizo un daño de '.$hero->atq.' a '. $enemy->name
                ];
            }else{ // si el enemigo muere
                return [
                    'winner' => 'hero',
                    'text' => $hero->name . ' acabó con la vida de '. $enemy->name . ' y ganó '. $enemy->xp. ' de experiencia.'
                ];

                $hero->xp = $hero->xp + $enemy->xp;
                if ($hero->xp >= $hero->level->xp){
                    $hero->xp = 0; 
                    $hero->level_id += 1; 
                }
                $hero->save();

            }  
        }else{
            $hp = $hero->def - $enemy->atq;
            if ($hp < 0){
                $hero->hp -= $hp * -1;
            }
            if ($hero->hp > 0){ 
                return [
                    'winner' => 'enemy',
                    'text' => $hero->name . ' recibió un daño de '.$enemy->atq.' por '. $enemy->name
                ];
            }else{  // el hero esta muerto
                return [
                    'winner' => 'enemy',
                    'text' => $hero->name . ' fue asesinado por '. $enemy->name
                ];
            }    
        }
    }
}
