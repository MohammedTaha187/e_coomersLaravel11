<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecouponRequest;
use App\Http\Requests\UpdatecouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::orderBy('expiry_date', 'DESC')->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecouponRequest $request)
    {
        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->save();
        return redirect()->route('admin.coupons')->with('success', 'Coupon created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecouponRequest $request, Coupon $coupon)
    {
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->save();
        return redirect()->route('admin.coupons')->with('success', 'Coupon updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons')->with('success', 'Coupon deleted successfully.');
    }

    public function search(Request $request)
    {
        $search = trim($request->input('search'));

        $coupons = Coupon::when($search, function ($query) use ($search) {
            $query->where('code', 'LIKE', "%{$search}%")
                ->orWhere('type', 'LIKE', "%{$search}%")
                ->orWhere('value', 'LIKE', "%{$search}%")
                ->orWhere('cart_value', 'LIKE', "%{$search}%")
                ->orWhere('expiry_date', 'LIKE', "%{$search}%");
        })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('admin.coupons.index', compact('coupons'));
    }
}
