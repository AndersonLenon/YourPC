<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PartCollection;
use App\Http\Resources\PartResource;
use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{

    public function index()
    {
        $parts = Part::all();

        return response()->json([
            'success' => true,
            'data' => $parts,
        ], 200);
 
    }

    public function show($id)
    {
        $part = Part::find($id);
        if (!$part) {
            return response()->json([
                'success' => false,
                'message' => 'Part not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $part,
        ], 200);
    }
    

    public function store(Request $request)
    {
        // Validar os dados recebidos
        $request->validate([
            'name' => 'required|string',
            'image_path' => 'nullable|string',  // `nullable` para permitir campos vazios
            'description' => 'required|string',
            'price' => 'required|numeric',
            'purchase_link' => 'required|url',
            'category' => 'required|string',
            'brand' => 'required|string',
            'stock' => 'nullable|integer',
            'rating' => 'nullable|numeric|between:0,5',
            'release_date' => 'nullable|date',
            'specs' => 'nullable|array',  // Permitindo que o campo `specs` seja um array
        ]);
    
        try {
            // Criação da peça
            $part = Part::create([
                'name' => $request->name,
                'image_path' => $request->image_path,
                'description' => $request->description,
                'price' => $request->price,
                'purchase_link' => $request->purchase_link,
                'category' => $request->category,
                'brand' => $request->brand,
                'stock' => $request->stock,
                'rating' => $request->rating,
                'release_date' => $request->release_date,
                'specs' => $request->specs,
            ]);
    
            // Retorna a resposta de sucesso
            return response()->json([
                'status' => 'success',
                'message' => 'Peça inserida com sucesso',
                'data' => $part
            ], 201);
        } catch (\Exception $e) {
            // Captura qualquer erro e retorna uma resposta mais detalhada
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao processar a requisição',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        // Atualizar uma peça específica.
        $part = Part::findOrFail($id);

        $validated = $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'price' => 'numeric|min:0',
            'image_url' => 'nullable|url',
            'purchase_link' => 'nullable|url',
        ]);

        $part->update($validated);

        return response()->json($part);
    }

    public function destroy($id)
    {
        // Deletar uma peça.
        $part = Part::findOrFail($id);
        $part->delete();

        return response()->json(['message' => 'Peça deletada com sucesso']);
    }

    public function showPage()
    {
        
        return view('parts.index');
    }

}
