<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\User;
use App\Models\UnitRumah;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $progressList = Progress::with(['unit', 'pengawas'])->latest()->paginate(10);
        return view('admin.masterdata.progress.index', compact('progressList'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Ambil semua unit rumah yang belum selesai
    $units = \App\Models\UnitRumah::all();
    $pengawas = \App\Models\User::where('role', 'pengawas')->get();

    // Ambil data progress terakhir berdasarkan id_progres
    $last = \App\Models\Progress::orderBy('id_progres', 'desc')->first();

    // Ekstrak angka terakhir dari id_progres terakhir
    if ($last && preg_match('/PROG-(\d{4})$/', $last->id_progres, $matches)) {
        $lastNumber = (int) $matches[1];
    } else {
        $lastNumber = 0;
    }

    $nextNumber = $lastNumber + 1;
    $id_progres = 'PROG-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

    // Filter hanya unit yang belum selesai dibangun DAN BELUM memiliki ID progres
    $units = $units->filter(function ($unit) use ($id_progres) {
        return $unit->status !== 'Selesai Pembangunan' && !Progress::where('id_unit', $unit->id_unit)->exists();
    });

    // Jika tidak ada unit tersedia, redirect kembali
    if ($units->isEmpty()) {
        return redirect()->route('admin.masterdata.progress.index')->with('error', 'Tidak ada unit rumah yang tersedia untuk menambahkan progress.');
    }

    return view('admin.masterdata.progress.create', compact('units', 'pengawas', 'id_progres'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'id_unit' => 'required|exists:unit_rumahs,id_unit',
            'id_progres' => 'required|string|unique:progress,id_progres',
            'id_pengawas' => 'required|exists:users,id',
            'foto' => 'nullable|image|max:2048',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'status' => 'required|string',
            'jenis' => 'required|string',
        ]);



        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('progress', 'public');
        }

        \App\Models\Progress::create($validated);

        return redirect()->route('admin.masterdata.progress.index')->with('success', 'Progress berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Progress $progress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_progres)
    {
        $progress = Progress::findOrFail($id_progres);
        $units = UnitRumah::all();
        $pengawas = User::where('role', 'pengawas')->get();
        return view('admin.masterdata.progress.edit', compact('progress', 'units', 'pengawas'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Progress $progress)
{
    $validated = $request->validate([
        'id_unit' => 'required|exists:unit_rumahs,id_unit',
        'id_pengawas' => 'required|exists:users,id',
        'tanggal' => 'required|date',
        'deskripsi' => 'nullable|string',
        'foto' => 'nullable|image|max:2048',
        'status' => 'required|string',
        'jenis' => 'required|string',
    ]);

    if ($request->hasFile('foto')) {
        $validated['foto'] = $request->file('foto')->store('progress', 'public');
    }

    $progress->update($validated);

    return redirect()->route('admin.masterdata.progress.index')->with('success', 'Progress berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_progres)
    {
        $progress = Progress::findOrFail($id_progres);

        // Hapus foto jika ada
        if ($progress->foto) {
            \Storage::disk('public')->delete($progress->foto);
        }

        $progress->delete();

        return redirect()->route('admin.masterdata.progress.index')->with('success', 'Progress berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Jangan jalankan jika query kosong (opsional)
        if (!$query) {
            return redirect()->back()->with('error', 'Masukkan nomor rumah terlebih dahulu.');
        }

        // Ambil hasil dari database
        $results = DB::table('progress')
            ->where('id_unit', 'like', "%{$query}%")
            ->orWhere('id_progres', 'like', "%{$query}%")
            ->orWhere('id_pengawas', 'like', "%{$query}%")
            ->get();

        // Kirim ke view
        return view('search-results', compact('results', 'query'));
    }



}
