<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluasi;
use App\Models\Progress;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EvaluasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evaluasis = Evaluasi::with('progres')->get();
        return view('admin.evaluasi.index', compact('evaluasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil ID terakhir
        $lastEvaluasi = Evaluasi::orderBy('id_evaluasi', 'desc')->first();

        if ($lastEvaluasi) {
            // Ambil angka dari format EVAL-0001, lalu tambah 1
            $number = (int) substr($lastEvaluasi->id_evaluasi, 5) + 1;
            $newId = 'EVAL-' . str_pad($number, 4, '0', STR_PAD_LEFT);
        } else {
            $newId = 'EVAL-0001';
        }

        $progress = Progress::all(); // untuk dropdown
        return view('admin.evaluasi.create', compact('newId', 'progress'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_evaluasi' => 'required|unique:evaluasis,id_evaluasi',
            'id_progres' => 'required',
            'status' => 'required',
            'catatan' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        Evaluasi::create([
            'id_evaluasi' => $request->id_evaluasi,
            'id_progres' => $request->id_progres,
            'status' => $request->status,
            'catatan' => $request->catatan,
            'foto' => $request->hasFile('foto') ? $request->file('foto')->store('evaluasi', 'public') : null,
        ]);

        return redirect()->route('admin.evaluasi.index')->with('success', 'Evaluasi berhasil ditambahkan.');
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
    public function edit(Evaluasi $evaluasi)
    {
        $progress = Progress::all();
        return view('admin.evaluasi.edit', compact('evaluasi', 'progress'));
    }


    /**
     * Update the specified resource in storage.
     */

public function update(Request $request, Evaluasi $evaluasi)
{
    // dd($request->all());
    $request->validate([
        'id_evaluasi' => 'required|string',
        'id_progres' => 'required|string',
        'status' => 'required',
        'catatan' => 'nullable|string',
        'foto' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['status', 'catatan']);

    if ($request->hasFile('foto')) {
        if ($evaluasi->foto && Storage::disk('public')->exists($evaluasi->foto)) {
            Storage::disk('public')->delete($evaluasi->foto);
        }

        $data['foto'] = $request->file('foto')->store('evaluasi', 'public');
    }

    $evaluasi->update($data);

    return redirect()->route('admin.evaluasi.index')->with('success', 'Evaluasi berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluasi $evaluasi)
    {
        $evaluasi->delete();
        return back()->with('success', 'Evaluasi berhasil dihapus.');
    }
}
