<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use App\Models\Evaluasi;

class PengawasEvaluasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $evaluasiList = Evaluasi::when($search, function ($query, $search) {
                return $query->where('id_evaluasi', 'like', "%{$search}%")
                             ->orWhere('status', 'like', "%{$search}%");
            })
            ->orderByDesc('created_at')
            ->get(); // Ganti ke ->paginate(10) jika ingin pagination

        return view('pengawas.evaluasi.index', compact('evaluasiList'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $evaluasi = Evaluasi::findOrFail($id);

        return view('pengawas.evaluasi.show', compact('evaluasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $evaluasi = Evaluasi::findOrFail($id);

        return view('pengawas.evaluasi.edit', compact('evaluasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'id_evaluasi' => 'required|string',
        'id_progres' => 'required|string',
        'status' => 'required',
        'catatan' => 'nullable|string',
        'foto' => 'nullable|image|max:2048',
    ]);

    $evaluasi = Evaluasi::findOrFail($id);
    $evaluasi->id_evaluasi = $request->id_evaluasi;
    $evaluasi->id_progres = $request->id_progres;
    $evaluasi->status = $request->status;
    $evaluasi->catatan = $request->catatan;

    if ($request->hasFile('foto')) {
    // Hapus foto lama jika ada
    if ($evaluasi->foto && Storage::disk('public')->exists($evaluasi->foto)) {
        Storage::disk('public')->delete($evaluasi->foto);
    }

    $path = $request->file('foto')->store('evaluasi', 'public');
    $evaluasi->foto = $path;
}


    $evaluasi->save();

    return redirect()->route('pengawas.evaluasi.index')->with('success', 'Evaluasi berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $evaluasi = Evaluasi::findOrFail($id);
        $evaluasi->delete();

        return redirect()->route('pengawas.evaluasi.index')->with('success', 'Evaluasi deleted successfully.');
    }
}
