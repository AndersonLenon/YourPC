<?php

namespace App\Http\Controllers\Api;

use App\Models\Build;
use App\Models\BuildPart;
use Illuminate\Http\Request;

class BuildController extends Controller
{
    public function index()
    {
        // Retornar todas as builds do usuário autenticado.
        $builds = Build::where('user_id', auth()->id())->with('parts')->get();
        return response()->json($builds);
    }

    public function show($id)
    {
        // Exibir uma build específica do usuário autenticado.
        $build = Build::where('id', $id)->where('user_id', auth()->id())->with('parts')->firstOrFail();
        return response()->json($build);
    }

    public function store(Request $request)
    {
        // Validar os dados enviados.
        $validated = $request->validate([
            'name' => 'nullable|string|max:255', // Nome é opcional.
            'description' => 'nullable|string|max:1000',
            'parts' => 'required|array|min:2', // Mínimo de duas peças.
            'parts.*' => 'exists:parts,id', // IDs devem existir na tabela 'parts'.
        ]);
    
        if (auth()->check()) {
            // Usuário autenticado: Salva no banco de dados.
            $build = Build::create([
                'name' => $validated['name'] ?? 'Minha Montagem',
                'description' => $validated['description'] ?? null,
                'user_id' => auth()->id(),
            ]);
    
            // Associar as peças à montagem.
            $build->parts()->sync($validated['parts']);
    
            return response()->json([
                'message' => 'Build salva com sucesso!',
                'build' => $build->load('parts'), // Retorna a build com as peças associadas.
            ], 201);
        }
    
        // Visitante: Retorna uma configuração temporária sem salvar.
        return response()->json([
            'message' => 'Configuração criada temporariamente. Faça login para salvar.',
            'temporary_build' => [
                'name' => $validated['name'] ?? 'Montagem Temporária',
                'description' => $validated['description'] ?? null,
                'parts' => $validated['parts'],
            ],
        ], 200);
    }
    
    public function update(Request $request, $id)
    {
        // Atualizar uma build específica.
        $build = Build::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'parts' => 'nullable|array|min:2',
            'parts.*' => 'exists:parts,id',
        ]);

        $build->update([
            'name' => $validated['name'] ?? $build->name,
            'description' => $validated['description'] ?? $build->description,
        ]);

        if (isset($validated['parts'])) {
            // Atualizar as peças associadas.
            $build->parts()->sync($validated['parts']);
        }

        return response()->json($build->load('parts'));
    }

    public function destroy($id)
    {
        // Deletar uma build específica.
        $build = Build::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $build->delete();

        return response()->json(['message' => 'Montagem deletada com sucesso']);
    }
}
