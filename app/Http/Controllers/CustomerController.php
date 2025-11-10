<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    // ค้นหาลูกค้าตาม cardID
    public function findByCardID(Request $request): JsonResponse
    {
        $request->validate([
            'cardID' => 'required|string'
        ]);

        $customer = Customer::where('cardID', $request->cardID)->first();

        if ($customer) {
            return response()->json([
                'success' => true,
                'data' => $customer
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'ไม่พบรหัสลูกค้านี้'
        ], 404);
    }

    // ดึงข้อมูลลูกค้าตาม cardID (สำหรับหน้า detail)
    public function showByCardID($cardID): JsonResponse
    {
        $customer = Customer::where('cardID', $cardID)->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $customer
        ]);
    }

    // อัปเดตข้อมูลลูกค้าตาม cardID
    public function updateByCardID(Request $request, $cardID): JsonResponse
    {
        $customer = Customer::where('cardID', $cardID)->firstOrFail();

        $request->validate([
            'name' => 'required|string',
            'tel' => 'required|string',
            'gen' => 'required|in:male,female'
        ]);

        $customer->update([
            'name' => $request->name,
            'tel' => $request->tel,
            'gen' => $request->gen
        ]);

        return response()->json([
            'success' => true,
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'data' => $customer
        ]);
    }
}