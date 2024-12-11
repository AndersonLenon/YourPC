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
        // Criar uma nova peça.
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
            'purchase_link' => 'nullable|url',
        ]);

        $part = Part::create($validated);

        return response()->json($part, 201);
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
