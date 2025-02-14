<?php
namespace App\Http\Controllers;

use App\Enum\Status;
use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tarefa = Tarefa::paginate(10);

            return view('tarefa.index', compact($tarefa));
        } catch (\Exception $e) {
            return redirect()->route('erro.generico')->with('error', 'Erro ao carregar tarefas!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $tarefasValidadas = $request->validate([
                'descricao'  => 'required|string|max:255',
                'status'     => 'required|in:' . Status::PENDENTE . ',' . Status::CONCLUIDO,
                'id_projeto' => 'required|exists:projeto,id',
            ]);

            $tarefa = Tarefa::create([
                'descricao'  => $tarefasValidadas['descricao'],
                'status'     => $tarefasValidadas['status'],
                'id_projeto' => $tarefasValidadas['id_projeto'],
            ]);

            return response()->json($tarefa, 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro ao criar uma nova tarefa.'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarefa $tarefa)
    {
        return response()->json(['tarefa' => $tarefa], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarefa $tarefa)
    {
        return view('tarefa.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        try {
            $tarefasValidadas = $request->validate([
                'descricao'  => 'required|string|max:255',
                'status'     => 'required|in:' . Status::PENDENTE . ',' . Status::CONCLUIDO,
                'id_projeto' => 'required|exists:projeto,id',
            ]);

            $tarefa->update([
                'descricao'  => $tarefasValidadas['descricao'] ?? $tarefa->descricao,
                'status'     => $tarefasValidadas['status'] ?? $tarefa->status,
                'id_projeto' => $tarefasValidadas['id_projeto'] ?? $tarefa->id_projeto,
            ]);

            return response()->json($tarefa, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro ao atualizar a tarefa.'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete();

        return response()->json(['message' => 'Tarefa deletada.'], 200);

    }
}
