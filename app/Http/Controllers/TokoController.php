<?php
namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function index()
    {
        $tokos = Toko::all();
        return view('tokos.index', compact('tokos'));
    }
    public function create()
    {
        $users = \App\Models\User::all();
        $cities = \App\Models\City::all();
        return view('tokos.create', compact('users', 'cities'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'owner_id' => 'required|exists:users,id',
            'name_toko' => 'required|string|max:255|unique:tokos,name_toko',
            'city_code' => 'required|exists:cities,id',
        ]);
        Toko::create($request->all());
        return redirect()->route('tokos.index')
                         ->with('success', 'Toko created successfully.');
    }
    public function show(Toko $toko)
    {
        return view('tokos.show', compact('toko'));
    }
    public function edit(Toko $toko)
    {
        return view('tokos.edit', compact('toko'));
    }
    public function update(Request $request, Toko $toko)
    {
        $request->validate([
            'owner_id' => 'required|exists:users,id',
            'name_toko' => 'required|string|max:255|unique:tokos,name_toko,' . $toko->id,
            'city_code' => 'required|exists:cities,id',
        ]);
        $toko->update($request->all());
        return redirect()->route('tokos.index')
                         ->with('success', 'Toko updated successfully.');
    }
    public function destroy(Toko $toko)
    {
        $toko->delete();
        return redirect()->route('tokos.index')
                         ->with('success', 'Toko deleted successfully.');
    }
}
