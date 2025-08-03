<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use App\Models\Progress;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display the evaluation form for a specific unit.
     *
     * @param  int  $unit
     * @return \Illuminate\View\View
     */

    public function form($unit)
    {
        // Cek apakah unit dan progres ada
        $progress = Progress::where('id_unit', $unit)->first();
        if (!$progress) {
            abort(404, 'Progress not found for this unit.');
        }

        // Cukup kirim unit ke view
        return view('guest-evaluasi', compact('unit', 'progress'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi
        $validated = $request->validate([
            'id_unit' => 'required',
            'id_progres' => 'required',
            'status' => 'required|in:sesuai,perlu revisi',
            'catatan' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Generate ID Evaluasi otomatis
        $lastEvaluasi = Evaluasi::orderBy('id_evaluasi', 'desc')->first();
        if ($lastEvaluasi) {
            $number = (int) substr($lastEvaluasi->id_evaluasi, 5) + 1;
            $newId = 'EVAL-' . str_pad($number, 4, '0', STR_PAD_LEFT);
        } else {
            $newId = 'EVAL-0001';
        }

        // Handle upload foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('evaluasi', 'public');
        }

        // Simpan data evaluasi
        Evaluasi::create([
            'id_evaluasi' => $newId,
            'id_unit' => $validated['id_unit'],
            'id_progres' => $validated['id_progres'],
            'status' => $validated['status'],
            'catatan' => $validated['catatan'],
            'foto' => $fotoPath,
        ]);

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('guest.evaluasi.form', ['unit' => $validated['id_unit']])
                         ->with('success', 'Evaluasi berhasil disimpan.');
    }
}
