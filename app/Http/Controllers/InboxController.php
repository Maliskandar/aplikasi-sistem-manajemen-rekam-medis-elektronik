<?php

namespace App\Http\Controllers;
use App\Models\Inbox;
use App\Models\AncRecord;
use App\Models\Prescription;
use Illuminate\Routing\Controller;

use Illuminate\Http\Request;

class InboxController extends Controller
{

    public function index()
    {
        $inbox = Inbox::latest()->get();
        return view('asisten.inbox.index', compact('inbox'));
    }

    public function lihatResepANC($id)
    {
        $anc = \App\Models\AncRecord::with('patientService.patient')->findOrFail($id);
        $resep = \App\Models\Prescription::where('patient_service_id', $anc->patient_service_id)->get();

        return view('asisten.inbox.resep-anc', compact('anc', 'resep'));
    }


}