<?php

namespace App\Http\Controllers;

use App\SalespotCategoryType;
use Illuminate\Http\Request;

class SalespotCategoryTypeController extends Controller
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
     * @param  \App\SalespotCategoryType  $salespotCategoryType
     * @return \Illuminate\Http\Response
     */
    public function show(SalespotCategoryType $salespotCategoryType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalespotCategoryType  $salespotCategoryType
     * @return \Illuminate\Http\Response
     */
    public function edit(SalespotCategoryType $salespotCategoryType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SalespotCategoryType  $salespotCategoryType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalespotCategoryType $salespotCategoryType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SalespotCategoryType  $salespotCategoryType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalespotCategoryType $salespotCategoryType)
    {
        //
    }


    public function getlist(){
        return SalespotCategoryType::paginate(50);
    }
}
