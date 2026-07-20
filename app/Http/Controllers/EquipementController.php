<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipement;

class EquipementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipements = Equipement::all();
        $totalCount = $equipements->count();
        $actifCount = $equipements->where('statut', 'Actif')->count();
        $maintenanceCount = $equipements->where('statut', 'En maintenance')->count();
        return view('equipements.index', compact('equipements', 'totalCount', 'actifCount', 'maintenanceCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom'              => 'required|string|max:255',
            'type'             => 'required|string|max:50',
            'adresse_ip'       => 'required|ip|unique:equipements,adresse_ip',
            'date_acquisition' => 'required|date',
            'statut'           => 'required|string|in:Actif,En maintenance',
        ]);

        Equipement::create($validatedData);
        return redirect()->route('equipements.index')
                         ->with('success', 'L\'équipement a été ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipement $equipement)
    {
        return view('equipements.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipement $equipement)
    {
        return view('equipements.edit', compact('equipement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipement $equipement)
    {
        $validatedData = $request->validate([
            'nom'              => 'required|string|max:255',
            'type'             => 'required|string|max:50',
            // Ignore the current equipment's IP for the uniqueness rule
            'adresse_ip'       => 'required|ip|unique:equipements,adresse_ip,' . $equipement->id,
            'date_acquisition' => 'required|date',
            'statut'           => 'required|string|in:Actif,En maintenance',
        ]);

        $equipement->update($validatedData);
        return redirect()->route('equipements.index')
                         ->with('success', 'Les informations de l\'équipement ont été mises à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipement $equipement)
    {
        $equipement->delete();
        return redirect()->route('equipements.index')
                         ->with('success', 'L\'équipement a été retiré de l\'inventaire avec succès.');
    }
}
