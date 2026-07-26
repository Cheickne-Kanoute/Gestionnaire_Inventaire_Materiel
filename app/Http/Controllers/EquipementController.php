<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipement;

class EquipementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $all              = \App\Models\Equipement::all();
        $totalCount       = $all->count();
        $actifCount       = $all->where('statut', 'Actif')->count();
        $maintenanceCount = $all->where('statut', 'En maintenance')->count();
        $tauxOp           = $totalCount > 0 ? round(($actifCount / $totalCount) * 100) : 0;
        $totalValeur      = $all->sum('prix');

        // Distribution par type
        $byType = $all->groupBy('type')->map->count();

        // 5 derniers équipements
        $recents = \App\Models\Equipement::latest()->take(5)->get();

        return view('equipements.dashboard', compact(
            'totalCount', 'actifCount', 'maintenanceCount', 'tauxOp', 'byType', 'recents', 'totalValeur'
        ));
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $type   = $request->input('type');

        // Always compute stats from ALL equipment (not filtered)
        $allEquipements   = Equipement::all();
        $totalCount       = $allEquipements->count();
        $actifCount       = $allEquipements->where('statut', 'Actif')->count();
        $maintenanceCount = $allEquipements->where('statut', 'En maintenance')->count();

        // Apply filters for the displayed list
        $query = Equipement::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', '%' . $search . '%')
                  ->orWhere('adresse_ip', 'like', '%' . $search . '%');
            });
        }

        if ($type) {
            $query->where('type', $type);
        }

        $equipements = $query->get();

        return view('equipements.index', compact(
            'equipements', 'totalCount', 'actifCount', 'maintenanceCount', 'search', 'type'
        ));
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
            'prix'             => 'nullable|numeric|min:0',
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
            'prix'             => 'nullable|numeric|min:0',
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
