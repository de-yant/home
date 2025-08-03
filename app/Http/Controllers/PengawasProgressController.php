<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengawasProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Progress::with('unit')
        ->where('id_pengawas', auth()->id());

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('deskripsi', 'like', "%$search%")
              ->orWhereHas('unit', function ($sub) use ($search) {
                  $sub->where('no_rumah', 'like', "%$search%");
              });
        });
    }

    $progress = $query->orderBy('tanggal', 'desc')->paginate(10);

    return view('pengawas.progress.index', compact('progress'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logic to show the form for creating a new progress entry
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Logic to store a new progress entry
    }

    /**
     * Display the specified resource.
     */
    public function show($id_progress)
    {
        $progress = Progress::with('unit')->findOrFail($id_progress);
        return view('pengawas.progress.show', compact('progress'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_progress)
    {
        $progress = Progress::findOrFail($id_progress);
        return view('pengawas.progress.edit', compact('progress'));

    }

    /**
     * Update the specified resource in storage.
     */

public function update(Request $request, $id_progress)
{
    $progress = Progress::findOrFail($id_progress);

    $validated = $request->validate([
        'tanggal' => 'required|date',
        'deskripsi' => 'required|string',
        'foto' => 'nullable|image|max:2048',
    ]);

    // Jika ada upload foto baru
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($progress->foto && Storage::disk('public')->exists($progress->foto)) {
            Storage::disk('public')->delete($progress->foto);
        }

        // Upload foto baru dan simpan path-nya
        $validated['foto'] = $request->file('foto')->store('progress', 'public');
    } else {
        // Jangan ubah foto jika tidak ada upload baru
        unset($validated['foto']);
    }

    $progress->update($validated);

    return redirect()->route('pengawas.progress.index')->with('success', 'Progress berhasil diperbarui.');
}


}
