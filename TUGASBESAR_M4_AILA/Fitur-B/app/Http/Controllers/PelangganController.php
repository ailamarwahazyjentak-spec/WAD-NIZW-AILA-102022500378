<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function index()
    {
        
        $pelanggan = User::with('addresses')->get();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|min:6',
            'phone_number'   => 'required|string|max:15',
            'full_address'   => 'required|string',
        ]);

        
        $user = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'phone_number' => $request->phone_number,
        ]);

        
        CustomerAddress::create([
            'user_id'        => $user->id,
            'recipient_name' => $request->name,
            'phone_number'   => $request->phone_number,
            'full_address'   => $request->full_address,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan dan alamat berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); 

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus!');
    }
}