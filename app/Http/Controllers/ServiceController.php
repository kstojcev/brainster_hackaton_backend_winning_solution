<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::get();
        $servicesCount = Service::get()->count();
        return view('services.index', compact('services', 'servicesCount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $service = new Service();
        $service->title = $request->title;

        if ($service->save()) {
            return redirect()->route('dashboard.services')->with('created', 'Service created!');
        };

        return redirect()->route('dashboard.services')->with('error', 'Whoops! Something went wrong.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $service->title = $request->title;

        if ($service->save()) {
            return redirect()->route('dashboard.services')->with('edited', 'Service edited!');
        };

        return redirect()->route('dashboard.services')->with('error', 'Whoops! Something went wrong.');
    }
}
