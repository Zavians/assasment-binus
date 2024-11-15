<?php

namespace App\Http\Controllers;

use App\Models\Approver;
use Illuminate\Http\Request;

class approverController extends Controller
{
    public function index() {
        $dataApprover = Approver::first();
    
        return view('pages.approver.index', compact('dataApprover'));
    }

    public function approve() {
        $approver = Approver::first();
        if ($approver) {
            $approver->update(['status' => 'Disetujui']);
            return redirect()->back()->with('success', 'Status updated to "Disetujui".');
        }
    
        return redirect()->back()->with('error', 'No records found to approve.');
    }
    
    public function reject() {
        $approver = Approver::first();
        if ($approver) {
        
            $approver->update(['status' => 'Dikembalikan']);
            return redirect()->back()->with('success', 'Status updated to "Dikembalikan".');
        }
    
        return redirect()->back()->with('error', 'No records found to reject.');
    }
    
}
