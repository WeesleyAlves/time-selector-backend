<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipe;

class ControllerEquipes extends Controller
{
    public function getAll() {
        $equipes = Equipe::get();
        //dd($x);
        //print_r($x[1]);
        //echo $x;
        //return (json_encode(md5($x)));
        return(json_encode($equipes));
    }
}
