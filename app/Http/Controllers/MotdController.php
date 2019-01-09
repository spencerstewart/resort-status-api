<?php

namespace App\Http\Controllers;

use App\Motd;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MotdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Motd::whereDate('created_at', Carbon::today())->latest('updated_at')->take(10)->get();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Motd  $motd
     * @return \Illuminate\Http\Response
     */
    public function show(Motd $motd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Motd  $motd
     * @return \Illuminate\Http\Response
     */
    public function edit(Motd $motd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Motd  $motd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Motd $motd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Motd  $motd
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motd $motd)
    {
        //
    }
}
