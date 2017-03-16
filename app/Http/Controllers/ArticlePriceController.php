<?php

namespace App\Http\Controllers;

use App\ArticlePrice;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\SoftDeletes;

class ArticlePriceController extends Controller
{
    use SoftDeletes;

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
     * @param  \App\ArticlePrice  $articlePrice
     * @return \Illuminate\Http\Response
     */
    public function show(ArticlePrice $articlePrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ArticlePrice  $articlePrice
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticlePrice $articlePrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArticlePrice  $articlePrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArticlePrice $articlePrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ArticlePrice  $articlePrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticlePrice $articlePrice)
    {
        //
    }
}
