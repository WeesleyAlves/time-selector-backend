<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $fillable = ['id_equipe','nome','local','horaEntrada','horaSaida'];

    //public $incremeting = false;
}
