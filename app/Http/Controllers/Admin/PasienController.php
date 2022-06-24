<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = user::all();
        $pasiens = Pasien::with('user')->get();

        return view('admin.pasien.index', ['pasiens' => $pasiens,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'role_id' => 3
        ]);

        $pasien = Pasien::create([
            'user_id' => $user->id,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat
        ]);

        if (!$pasien) return redirect()->route('admin.pasien.index')->with('status', 'Gagal menambahkan pasien baru');

        return redirect()->route('admin.pasien.index')->with('status', 'Sukses menambah pasien baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pasien = Pasien::with(['user', 'booking' => fn ($q) => $q->where('status', 'Selesai')->orderBy('tanggal', 'DESC'), 'booking.dokter', 'booking.transaksi'])->find($id);

        return view('admin.pasien.show', ['pasien' => $pasien]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pasien = Pasien::with('user')->find($id);

        return view('admin.pasien.edit', ['pasien' => $pasien]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $updateUser = $user->update($request->only('nama', 'no_hp', 'email'));
        $updatePasien = $user->pasien->update($request->only('tanggal_lahir', 'alamat'));

        // if (!$updateUser && !$updatePasien) return redirect()->route('admin.pasien.index')->with('status', 'Gagal mengubah data pasien');

        return redirect()->route('admin.pasien.index')->with('status', 'Sukses mengubah data pasien');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::destroy($id);

        if (!$user)  return redirect()->route('admin.pasien.index')->with('status', 'Gagal menghapus pasien');

        return redirect()->route('admin.pasien.index')->with('status', 'Sukses menghapus pasien');
    }
}
