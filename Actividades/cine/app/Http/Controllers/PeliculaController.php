<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('peliculas.index', [
            'peliculas' => Pelicula::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('peliculas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
        ]);
        $pelicula = new Pelicula($validated);
        $pelicula->save();
        session()->flash('exito', 'pelicula creada correctamente.');
        return redirect()->route('peliculas.show', $pelicula);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelicula $pelicula)
    {
        $entradas = $pelicula->proyecciones()->withCount('entradas')->get()->sum('entradas_count');
        return view('peliculas.show', [
            'pelicula' => $pelicula,
            'entradas' => $entradas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelicula $pelicula)
    {
        return view('peliculas.edit', [
            'pelicula' => $pelicula,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelicula $pelicula)
    {
        $validated = $request->validate([
            'titulo' => [
                'required',
                'string',
                'max:255',
            ],
        ]);
        $pelicula->fill($validated);
        $pelicula->save();
        session()->flash('exito', 'pelicula modificada correctamente.');
        return redirect()->route('peliculas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelicula $pelicula)
    {
        if($pelicula->proyecciones()->withCount('entradas')->get()->sum('entradas_count') == 0) {
            $pelicula->delete();
        } else {
            session()->flash('failure', 'pelicula no se puede borrar.');
        }
        return redirect()->route('peliculas.index');
    }
}
