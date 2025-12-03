<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreaddresseRequest;
use App\Http\Requests\UpdateaddresseRequest;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddresseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::where('user_id', Auth::user()->id)->get();
        return view('user.account.address.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.account.address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreaddresseRequest $request)
    {
        $address = new Address();
        $address->user_id = Auth::user()->id;
        $address->name = $request->name;
        $address->phone = $request->phone;
        $address->zip = $request->zip;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->address = $request->address;
        $address->locality = $request->locality;
        $address->landmark = $request->landmark;
        $address->country = $request->country;
        $address->type = $request->type;
        $address->isdefault = $request->isdefault ? true : false;
        $address->save();
        return redirect()->route('user.account.address')->with('success', 'Address added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $addresse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $address = Address::find($id);
        return view('user.account.address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateaddresseRequest $request, $id)
    {
        $address = Address::find($id);
        $address->name = $request->name;
        $address->phone = $request->phone;
        $address->zip = $request->zip;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->address = $request->address;
        $address->locality = $request->locality;
        $address->landmark = $request->landmark;
        $address->country = $request->country;
        $address->type = $request->type;
        $address->isdefault = $request->isdefault ? true : false;
        $address->save();
        return redirect()->route('user.account.address')->with('success', 'Address updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $address = Address::find($id);
        $address->delete();
        return redirect()->route('user.account.address')->with('success', 'Address deleted successfully');
    }
}
