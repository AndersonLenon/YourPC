<?php

namespace App\Http\Controllers\Api;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        // Retornar todas as peças favoritas do usuário autenticado.
        $favorites = Favorite::where('user_id', auth()->id())->with('part')->get();
        return response()->json($favorites);
    }

    public function store(Request $request)
    {
        // Adicionar uma peça aos favoritos.
        $validated = $request->validate([
            'part_id' => 'required|exists:parts,id',
        ]);

        $favorite = Favorite::firstOrCreate([
            'user_id' => auth()->id(),
            'part_id' => $validated['part_id'],
        ]);

        return response()->json($favorite->load('part'), 201);
    }

    public function destroy($id)
    {
        // Remover uma peça dos favoritos.
        $favorite = Favorite::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $favorite->delete();

        return response()->json(['message' => 'Peça removida dos favoritos']);
    }
}
