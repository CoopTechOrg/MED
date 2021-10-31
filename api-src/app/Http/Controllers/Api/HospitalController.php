<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return Hospital::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Hospital
     */
    public function store(Request $request): Hospital
    {
        $hospital = new Hospital();
        $hospital->name = $request->name;
        $hospital->save();
        return $hospital;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Hospital
     */
    public function show(int $id): Hospital
    {
        return Hospital::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Hospital
     */
    public function update(Request $request, int $id): Hospital
    {
        $hospital = Hospital::find($id);
        $hospital->name = $request->name;
        $hospital->save();
        return $hospital;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        Hospital::destroy($id);
        return response()->json();
    }
}
