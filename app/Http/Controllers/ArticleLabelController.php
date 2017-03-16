<?php

namespace App\Http\Controllers;

use App\ArticleLabel;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleLabelController extends Controller
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
     * @param  \App\ArticleLabel  $articleLabel
     * @return \Illuminate\Http\Response
     */
    public function show(ArticleLabel $articleLabel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ArticleLabel  $articleLabel
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticleLabel $articleLabel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArticleLabel  $articleLabel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArticleLabel $articleLabel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ArticleLabel  $articleLabel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleLabel $articleLabel)
    {
        //
    }
}
