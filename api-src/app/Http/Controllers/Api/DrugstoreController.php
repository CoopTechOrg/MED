<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Drugstore;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DrugstoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return Drugstore::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Drugstore
     */
    public function store(Request $request): Drugstore
    {
        $drugstore = new Drugstore();
        $drugstore->name = $request->name;
        $drugstore->save();
        return $drugstore;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Drugstore
     */
    public function show($id): Drugstore
    {
        return Drugstore::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Drugstore
     */
    public function update(Request $request, int $id): Drugstore
    {
        $drugstore = Drugstore::find($id);
        $drugstore->name = $request->name;
        $drugstore->save();
        return $drugstore;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id): Response
    {
        Drugstore::destroy($id);
        return response()->json();
    }
}
