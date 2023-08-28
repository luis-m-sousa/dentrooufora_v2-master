<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index (Request $request){
        return view('categoria.index', ['categorias' => Categoria::orderBy('id', 'desc')->paginate(5)]);
    }

    public function create(Request $request)
    {
        return view('categoria.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'nome' => 'required|max:100',
        ]);

        $obj = new Categoria();
        $obj->nome = $request->nome;
        $obj->save();

        return redirect()->route('categoria.index');
    }

    public function edit(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categoria.edit', ['categoria' => $categoria]);
    }
    public function update(Request $request, $id){
        $categoria = Categoria::findOrFail($id);

        $categoria->nome = $request->nome;
        $categoria->save();

       return redirect()->route('categoria.index');
    }
    public function delete(Request $request, $id){
        $obj = Categoria::findOrFail($id);
        $obj->delete();

        return redirect()->route('categoria.index');
    }

}
