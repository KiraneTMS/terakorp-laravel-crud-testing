<?php
namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::all();
        return view('hospitals.index', compact('hospitals'));
    }

    // Store a new hospital
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        Hospital::create($request->all());

        return response()->json(['success' => 'Hospital added successfully!']);
    }

    // Show a specific hospital in json
    public function show($id)
    {
        $hospital = Hospital::findOrFail($id);
        return response()->json($hospital);
    }

    // Update an existing hospital
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $hospital = Hospital::findOrFail($id);
        $hospital->update($request->all());

        return response()->json(['success' => 'Hospital updated successfully!']);
    }

    // Delete a hospital
    public function destroy($id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->delete();

        return response()->json(['success' => 'Hospital deleted successfully!']);
    }
}
