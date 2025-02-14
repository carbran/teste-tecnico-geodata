<?php
namespace App\Http\Controllers;

use App\Models\Projeto;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $projeto = Projeto::paginate(10);

            return view('projeto.index', compact($projeto));
        } catch (\Exception $e) {
            return redirect()->route('erro.generico')->with('error', 'Erro ao carregar projetos!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projeto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $projetoValidado = $request->validate([
                'titulo'       => 'required|string|max:255',
                'descricao'    => 'nullable|string|max:255',
                'data_entrega' => 'required|date',
            ]);

            $projeto = Projeto::create([
                'titulo'       => $projetoValidado['titulo'],
                'descricao'    => $projetoValidado['descricao'],
                'data_entrega' => $projetoValidado['data_entrega'],
            ]);

            return response()->json($projeto, 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro ao criar um novo projeto.'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Projeto $projeto)
    {
        return response()->json(['projeto' => $projeto], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projeto $projeto)
    {
        return view('projeto.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projeto $projeto)
    {
        try {
            $projetoValidado = $request->validate([
                'titulo'       => 'required|string|max:255',
                'descricao'    => 'nullable|string|max:255',
                'data_entrega' => 'required|date',
            ]);

            $projeto->update([
                'titulo' => $projetoValidado['titulo'] ?? $projeto->titulo,
                'descricao' => $projetoValidado['descricao'] ?? $projeto->descricao,
                'data_entrega' => $projetoValidado['data_entrega'] ?? $projeto->data_entrega,
            ]);

            return response()->json($projeto, 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro ao atualizar o projeto.'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projeto $projeto)
    {
        $projeto->delete();

        return response()->json(['message' => 'Projeto deletado.'], 200);
    }
}
