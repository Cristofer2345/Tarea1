<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tipoTarea()
    {
        return $this->belongsToMany(TipoTarea::class, 'tablamtipotarea', 'idTarea', 'idTipo');
    }
}
