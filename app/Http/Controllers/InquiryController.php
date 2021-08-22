<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inquiries = Inquiry::orderBy('active', 'DESC')->paginate(15);
        $inquiriesCount = Inquiry::count();

        return view('inquiries.index', compact('inquiries', 'inquiriesCount'));
    }

    /**
     * Download user scheme.
     */
    public function download($id)
    {
        $inquiry = Inquiry::where('id', $id)->firstOrFail();
        $pathToFile = public_path($inquiry->scheme);
        return response()->download($pathToFile);
    }
}
