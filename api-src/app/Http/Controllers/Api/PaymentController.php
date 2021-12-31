<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return Payment::query()
            ->join('payees', 'payments.payee_id', '=', 'payees.id')
            ->join('families', 'payments.family_id', '=', 'families.id')
            ->leftJoin('insurance_companies', 'payments.insurance_company_id', '=', 'insurance_companies.id')
            ->select([
                'payments.*',
                'payees.name AS payee_name',
                'families.name AS family_name',
                'insurance_companies.name AS insurance_company_name'
            ])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Payment
     */
    public function store(Request $request): Payment
    {
        $payment = new Payment();
        $payment->paid_at = new Carbon($request->paidAt);
        $payment->payee_id = $request->payeeId;
        $payment->family_id = $request->familyId;
        $payment->is_deducted = $request->isDeducted;
        $payment->is_own_expensed = $request->isOwnExpensed;
        $payment->insurance_company_id = $request->isOwnExpensed === true ? null : $request->insuranceCompanyId;
        $payment->price = $request->price;
        $payment->remarks = $request->remarks;
        $payment->save();
        return $payment;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Payment
     */
    public function show(int $id): Payment
    {
        return Payment::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Payment
     */
    public function update(Request $request, int $id): Payment
    {
        $payment = Payment::find($id);
        $payment->paid_at = new Carbon($request->paidAt);
        $payment->payee_id = $request->payeeId;
        $payment->family_id = $request->familyId;
        $payment->is_deducted = $request->isDeducted;
        $payment->is_own_expensed = $request->isOwnExpensed;
        $payment->insurance_company_id = $request->isOwnExpensed === true ? null : $request->insuranceCompanyId;
        $payment->price = $request->price;
        $payment->remarks = $request->remarks;
        $payment->save();
        return $payment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        Payment::destroy($id);
        return response()->json();
    }

    /**
     * 支払先別集計
     *
     * @return Collection
     */
    public function showPayeeSummary(): Collection
    {
        $query = Payment::query()
            ->join("payees", "payees.id", "=", "payments.payee_id")
            ->select(["payments.payee_id", "payees.name AS payee_name"])
            ->selectRaw("SUM(payments.price) AS total")
            ->groupBy(["payments.payee_id", "payees.name"]);
        return $query->get();
    }

    /**
     * 家族別集計
     *
     * @return Collection
     */
    public function showFamilySummary(): Collection
    {
        $query = Payment::query()
            ->join("families", "families.id", "=", "payments.family_id")
            ->select(["payments.family_id", "families.name AS family_name"])
            ->selectRaw("SUM(payments.price) AS total")
            ->groupBy(["payments.family_id", "families.name"]);
        return $query->get();
    }
}
