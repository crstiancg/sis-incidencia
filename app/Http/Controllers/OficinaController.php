<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOficinaRequest;
use App\Http\Resources\OficinaResource;
use App\Models\Oficina;
use App\Models\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class OficinaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:oficina index')->only('index');
        $this->middleware('can:oficina create')->only('create','store');
        $this->middleware('can:oficina update')->only('edit','update');
        $this->middleware('can:oficina delete')->only('destroy');
    }

    public function index()
    {
        // $oficinas = OficinaResource::collection(Oficina::with('sede','equipos')->get());
        $oficinas = Oficina::with('sede','equipos','perfils')->get();
        // dd($oficinas[0]);
        $sedes = Sede::all();
        return Inertia::render('admin/oficinas/Index', compact('oficinas','sedes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOficinaRequest $request)
    {
        $oficina = new Oficina();

        $oficina->nombre = $request->nombre;
        $oficina->sede_id = $request->sede;

        $oficina->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Oficina $oficina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Oficina $oficina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateOficinaRequest $request, Oficina $oficina)
    {
        $oficina->nombre = $request->nombre;
        $oficina->sede_id = $request->sede;

        $oficina->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Oficina $oficina)
    {
        $oficina->delete();

        return Redirect::back();
    }
}
