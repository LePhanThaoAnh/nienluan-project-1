<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Coupons\CreateCouponRequest;
use App\Http\Requests\Coupons\UpdateCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $coupon;
    public function __construct(Coupon $coupon){
        $this ->coupon = $coupon;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = $this->coupon->latest('id')->paginate(5);
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
    public function store(CreateCouponRequest $request)
    {
        $dateCreate = $request ->all();
        $this->coupon->create($dateCreate);

        return redirect()->route('coupons.index')->with(['message' => 'Create coupon succes']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = $this->coupon->findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, string $id)
    {
        $coupon = $this->coupon->findOrFail($id);

        $dataUpdate = $request ->all();
        $coupon->update($dataUpdate);
        return redirect()->route('coupons.index')->with(['message' => 'Update coupon succes']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = $this->coupon->findOrFail($id);
        $coupon->delete();

        return redirect()->route('coupons.index')->with(['message' => 'Delete '.$coupon->name.' success']);

    }
}
