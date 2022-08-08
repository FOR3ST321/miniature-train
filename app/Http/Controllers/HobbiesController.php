<?php

namespace App\Http\Controllers;

use App\Models\hobbies;
use App\Http\Requests\StorehobbiesRequest;
use App\Http\Requests\UpdatehobbiesRequest;

class HobbiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorehobbiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorehobbiesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\hobbies  $hobbies
     * @return \Illuminate\Http\Response
     */
    public function show(hobbies $hobbies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\hobbies  $hobbies
     * @return \Illuminate\Http\Response
     */
    public function edit(hobbies $hobbies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatehobbiesRequest  $request
     * @param  \App\Models\hobbies  $hobbies
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatehobbiesRequest $request, hobbies $hobbies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\hobbies  $hobbies
     * @return \Illuminate\Http\Response
     */
    public function destroy(hobbies $hobbies)
    {
        //
    }
}
