<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Obat;
use Illuminate\Support\Facades\DB;

class ObatController extends Controller
{
    // --- ELOQUENT ORM METHODS ---
    public function indexEloquent()
    {
        $obats = Obat::latest()->get();
        return view('obat.index', [
            'obats' => $obats,
            'type' => 'Eloquent ORM'
        ]);
    }

    public function storeEloquent(Request $request)
    {
        $validatedData = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'keterangan' => 'nullable|string'
        ]);

        Obat::create($validatedData);
        return back()->with('success', 'Obat berhasil ditambahkan (Eloquent)');
    }

    public function updateEloquent(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'keterangan' => 'nullable|string'
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update($validatedData);
        return back()->with('success', 'Obat berhasil diupdate (Eloquent)');
    }

    public function destroyEloquent($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();
        return back()->with('success', 'Obat berhasil dihapus (Eloquent)');
    }


    // --- QUERY BUILDER METHODS ---
    public function indexQueryBuilder()
    {
        $obats = DB::table('obats')->orderBy('created_at', 'desc')->get();
        return view('obat.index', [
            'obats' => $obats,
            'type' => 'Query Builder'
        ]);
    }

    public function storeQueryBuilder(Request $request)
    {
        $validatedData = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'keterangan' => 'nullable|string'
        ]);

        $validatedData['created_at'] = now();
        $validatedData['updated_at'] = now();

        DB::table('obats')->insert($validatedData);
        return back()->with('success', 'Obat berhasil ditambahkan (Query Builder)');
    }

    public function updateQueryBuilder(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'keterangan' => 'nullable|string'
        ]);

        $validatedData['updated_at'] = now();

        DB::table('obats')->where('id', $id)->update($validatedData);
        return back()->with('success', 'Obat berhasil diupdate (Query Builder)');
    }

    public function destroyQueryBuilder($id)
    {
        DB::table('obats')->where('id', $id)->delete();
        return back()->with('success', 'Obat berhasil dihapus (Query Builder)');
    }

}
