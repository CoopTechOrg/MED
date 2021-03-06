<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        $columns = [
            'families.*',
            'is_used' => function (Builder $query) {
                $query
                    ->selectRaw('CASE WHEN family_id IS NOT NULL THEN true ELSE false END AS is_used')
                    ->from('payments')
                    ->whereRaw('payments.family_id = families.id')
                    ->distinct();
            },
        ];
        return Family::select($columns)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Family
     */
    public function store(Request $request): Family
    {
        $family = new Family();
        $family->name = $request->name;
        $family->save();
        return $family;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Family
     */
    public function show(int $id): Family
    {
        return Family::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $family = Family::find($id);
        $family->name = $request->name;
        $family->save();
        return $family;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $query = Payment::query();
        $query->where('family_id', $id);

        if ($query->exists()) {
            // ??????????????????????????????????????????
            return response()->json(['message' => '????????????????????????????????????????????????']);
        }
        Family::destroy($id);
        return response()->json();
    }
}
