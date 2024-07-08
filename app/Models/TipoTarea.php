<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoTarea extends Model
{
    use HasFactory;
    protected $table = 'tipotarea';
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'tablamtipotarea', 'idTarea', 'idTipo');
    }
}
