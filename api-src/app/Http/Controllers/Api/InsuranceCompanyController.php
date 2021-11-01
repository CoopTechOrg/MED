<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InsuranceCompany;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InsuranceCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return InsuranceCompany::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return InsuranceCompany
     */
    public function store(Request $request): InsuranceCompany
    {
        $insuranceCompany = new InsuranceCompany();
        $insuranceCompany->name = $request->name;
        $insuranceCompany->save();
        return $insuranceCompany;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return InsuranceCompany
     */
    public function show(int $id): InsuranceCompany
    {
        return InsuranceCompany::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return InsuranceCompany
     */
    public function update(Request $request, int $id): InsuranceCompany
    {
        $insuranceCompany = InsuranceCompany::find($id);
        $insuranceCompany->name = $request->name;
        $insuranceCompany->save();
        return $insuranceCompany;
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
        $query->where('insurance_company_id', $id);

        if ($query->exists()) {
            // 使われてる家族なので削除不可
            return response()->json(['message' => '既に支払データに登録されています']);
        }
        InsuranceCompany::destroy($id);
        return response()->json();
    }
}
