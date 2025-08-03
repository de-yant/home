<?php

namespace App\Http\Controllers;

use App\Models\UnitRumah;
use Illuminate\Http\Request;

class UnitRumahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $search = $request->input('search');

        $units = UnitRumah::when($search, function ($query, $search) {
            $query->where('no_rumah', 'like', "%{$search}%")
                ->orWhere('alamat', 'like', "%{$search}%");
        })->paginate(3);
        return view('admin.masterdata.unit_rumah.index', compact('units'));
    }

    public function create()
    {
        $lastId = \App\Models\UnitRumah::orderBy('id_unit', 'desc')->pluck('id_unit')->first();

        if ($lastId) {
            $lastNumber = (int) str_replace('UNIT-', '', $lastId);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $generatedId = 'UNIT-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        return view('admin.masterdata.unit_rumah.create', compact('generatedId'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_unit' => 'required|unique:unit_rumahs,id_unit',
            'no_rumah' => 'required|unique:unit_rumahs,no_rumah',
            'type' => 'nullable|string|max:255',
            'alamat' => 'required',
            'id_penghuni' => 'nullable',
            'status' => 'required|in:Selesai Pembangunan,Dalam Proses,Belum Dibangun',
        ]);

        UnitRumah::create($request->all());

        return redirect()->route('admin.masterdata.unit-rumah.index')->with('success', 'Unit berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(UnitRumah $unitRumah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_unit)
    {
        $unitRumah = UnitRumah::findOrFail($id_unit);
        return view('admin.masterdata.unit_rumah.update', compact('unitRumah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UnitRumah $unitRumah)
    {
        // dd($request->all());
        $validated = $request->validate([

            'no_rumah' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'alamat' => 'required|string|max:255',
            'id_penghuni' => 'nullable',
            'status' => 'required|in:Selesai Pembangunan,Dalam Proses,Belum Dibangun',
        ]);

        // buat untuk id_unit generate otomatis
        if (!$unitRumah->id_unit) {
            $unitRumah->id_unit = 'UNIT-' . str_pad(UnitRumah::count() + 1, 4, '0', STR_PAD_LEFT);
        }

        $unitRumah->id_unit = $validated['id_unit'] ?? $unitRumah->id_unit;

        $unitRumah->no_rumah = $validated['no_rumah'];
        $unitRumah->type = $validated['type'] ?? null;
        $unitRumah->alamat = $validated['alamat'];
        $unitRumah->id_penghuni = $validated['id_penghuni'] ?? null;
        $unitRumah->status = $validated['status'];

        $unitRumah->save();

        return redirect()->route('admin.masterdata.unit-rumah.index')
            ->with('success', 'Unit berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_unit)
    {
        $unitRumah = UnitRumah::findOrFail($id_unit);
        $unitRumah->delete();

        return redirect()->route('admin.masterdata.unit-rumah.index')->with('success', 'Unit berhasil dihapus.');
    }
}
