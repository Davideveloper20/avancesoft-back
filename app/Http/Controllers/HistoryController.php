<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'doctorName' => 'required|string',
            'idDoctor' => 'required|string',
            'patientName' => 'required|string',
            'idPatient' => 'required|string',
            'dateRegister' => 'required|string',
            'statusPatient' => 'required|string',
            'recordPatient' => 'required|string',
            'evolutionPatient' => 'string',
            'concept' => 'string',
            'recommendation' => 'string',
            'patientImage' => 'json',
            'confirmedPatient' => 'boolean',
        ]);

        $history = History::create($request->all());

        return response()->json(['message' => 'Historia Clínica creada exitosamente back', 'history' => $history], 201);
    }

    public function getHistory($idDoctor)
    {
        $histories = History::where('idDoctor', $idDoctor)->get();

        return response()->json($histories);
    }

    public function getHistoryPatient($idPatient)
    {
        $histories = History::where('idPatient', $idPatient)->get();

        return response()->json($histories);
    }


    public function updateSignature(Request $request, $id)
    {

        $history = History::findOrFail($id);
        $history->confirmedPatient = true;
        $history->save();

        return response()->json(['message' => 'Firma de Paciente se realizó de manera exitosa', 'history' => $history]);
    }
}
