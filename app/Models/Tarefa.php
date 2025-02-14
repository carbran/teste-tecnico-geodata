<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    protected $table = 'tarefas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'descricao',
        'status',
        'id_projeto',
    ];

    protected $casts = [
        'status' => 'integer',
    ];

    public function tarefas()
    {
        return $this->belongsTo(Projeto::class, 'id_projeto');
    }
}
