<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Support\Str;
use App\Http\Requests\InquiryRequest;

class InquiryApiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InquiryRequest $request)
    {
        $inquiry = new Inquiry();
        $inquiry->email = $request->email;
        $inquiry->first_name = $request->first_name;
        $inquiry->last_name = $request->last_name;
        $inquiry->company = $request->company;
        $inquiry->location = $request->location;
        $inquiry->message = $request->message;
        if ($request->hasFile('scheme')) {
            $filePath = $this->UserSchemeUpload($request->file('image'), $request->company);
            $inquiry->scheme = $filePath;
        }
        $inquiry->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inquiry = Inquiry::where('id', $id)->first();
        $inquiry->delete();
        if ($inquiry->scheme) {
            unlink($inquiry->scheme);
        }
    }

    /**
     * Process the image for upload in storage.
     */
    public function UserSchemeUpload($query, $companyName)
    {
        $scheme_name = Str::random(20);
        // $scheme_name = $companyName . " scheme";
        $ext = strtolower($query->getClientOriginalExtension());
        $scheme_full_name = $scheme_name . '.' . $ext;
        $upload_path = 'storage/user_inquiry/';
        $scheme_url = $upload_path . $scheme_full_name;
        $success = $query->move($upload_path, $scheme_full_name);

        return $scheme_url;
    }

    /**
     * Activate (inactive) inquiry.
     */
    public function activateInquiry($id)
    {
        $inquiry = Inquiry::find($id);
        $inquiry->active = 1;
        $inquiry->save();
    }

    /**
     * Deactivate (active) inquiry.
     */
    public function deactivateInquiry($id)
    {
        $inquiry = Inquiry::find($id);
        $inquiry->active = 0;
        $inquiry->save();
    }
}
