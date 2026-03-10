<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    // --- ELOQUENT ORM METHODS ---
    public function indexEloquent()
    {
        $suppliers = Supplier::latest()->get();
        return view('supplier.index', [
            'suppliers' => $suppliers,
            'type' => 'Eloquent ORM'
        ]);
    }

    public function storeEloquent(Request $request)
    {
        $validatedData = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:suppliers,email',
            'keterangan' => 'nullable|string'
        ]);

        Supplier::create($validatedData);
        return back()->with('success', 'Supplier berhasil ditambahkan (Eloquent)');
    }

    public function updateEloquent(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:suppliers,email,' . $id,
            'keterangan' => 'nullable|string'
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($validatedData);
        return back()->with('success', 'Supplier berhasil diupdate (Eloquent)');
    }

    public function destroyEloquent($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return back()->with('success', 'Supplier berhasil dihapus (Eloquent)');
    }

    // --- QUERY BUILDER METHODS ---
    public function indexQueryBuilder()
    {
        $suppliers = DB::table('suppliers')->orderBy('created_at', 'desc')->get();
        return view('supplier.index', [
            'suppliers' => $suppliers,
            'type' => 'Query Builder'
        ]);
    }

    public function storeQueryBuilder(Request $request)
    {
        $validatedData = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:suppliers,email',
            'keterangan' => 'nullable|string'
        ]);

        $validatedData['created_at'] = now();
        $validatedData['updated_at'] = now();

        DB::table('suppliers')->insert($validatedData);
        return back()->with('success', 'Supplier berhasil ditambahkan (Query Builder)');
    }

    public function updateQueryBuilder(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:suppliers,email,' . $id,
            'keterangan' => 'nullable|string'
        ]);

        $validatedData['updated_at'] = now();

        DB::table('suppliers')->where('id', $id)->update($validatedData);
        return back()->with('success', 'Supplier berhasil diupdate (Query Builder)');
    }

    public function destroyQueryBuilder($id)
    {
        DB::table('suppliers')->where('id', $id)->delete();
        return back()->with('success', 'Supplier berhasil dihapus (Query Builder)');
    }
}
