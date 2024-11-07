<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Hospital;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with('hospital')->get();
        $hospitals = Hospital::all();
        return view('patients.index', compact('patients', 'hospitals'));
    }

    public function store(Request $request)
    {
        $patient = new Patient();
        $patient->name = $request->name;
        $patient->address = $request->address;
        $patient->phone = $request->phone;
        $patient->hospital_id = $request->hospital_id;
        $patient->save();

        return response()->json(['success' => true, 'patient' => $patient]);
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->name = $request->name;
        $patient->address = $request->address;
        $patient->phone = $request->phone;
        $patient->hospital_id = $request->hospital_id;
        $patient->save();

        return response()->json(['success' => true, 'patient' => $patient]);
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return response()->json(['success' => true]);
    }
}
