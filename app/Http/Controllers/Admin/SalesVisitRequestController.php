<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesVisitRequest;

class SalesVisitRequestController extends Controller
{
    public function index()
    {
        $requests = SalesVisitRequest::latest()->paginate(15);
        return view('admin.sales_visits.index', compact('requests'));
    }

    public function show($id)
    {
        $visit = SalesVisitRequest::findOrFail($id);

        // Mark as read
        if (!$visit->is_read) {
            $visit->update(['is_read' => true]);
        }

        return view('admin.sales_visits.show', compact('visit'));
    }

    public function destroy($id)
    {
        $visit = SalesVisitRequest::findOrFail($id);
        $visit->delete();

        return redirect()->route('admin.sales-visits.index')->with('success', 'Sales visit request deleted successfully.');
    }
}
