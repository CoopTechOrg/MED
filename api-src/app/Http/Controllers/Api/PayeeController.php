<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payee;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PayeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return Payee::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Payee
     */
    public function store(Request $request): Payee
    {
        $payee = new Payee();
        $payee->name = $request->name;
        $payee->is_hospital = $request->is_hospital;
        $payee->save();
        return $payee;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Payee
     */
    public function show(int $id): Payee
    {
        return Payee::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Payee
     */
    public function update(Request $request, int $id): Payee
    {
        $payee = Payee::find($id);
        $payee->name = $request->name;
        $payee->is_hospital = $request->is_hospital;
        $payee->save();
        return $payee;
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
        $query->where('payee_id', $id);

        if ($query->exists()) {
            // 使われてる家族なので削除不可
            return response()->json(['message' => '既に支払データに登録されています']);
        }
        Payee::destroy($id);
        return response()->json();
    }
}
