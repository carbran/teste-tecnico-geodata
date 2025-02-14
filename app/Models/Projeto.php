<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    protected $table = 'projetos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'titulo',
        'descricao',
        'data_entrega',
    ];

    protected $casts = [
        'data_entrega' => 'date',
    ];

    public function tarefas()
    {
        return $this->hasMany(Tarefa::class, 'id_projeto');
    }
}
