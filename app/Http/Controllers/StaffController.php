<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Staff;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    // --- ELOQUENT ORM METHODS ---
    public function indexEloquent()
    {
        $staffs = Staff::latest()->get();
        return view('staff.index', [
            'staffs' => $staffs,
            'type' => 'Eloquent ORM'
        ]);
    }

    public function storeEloquent(Request $request)
    {
        $validatedData = $request->validate([
            'nama_staff' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:staff,email',
            'keterangan' => 'nullable|string'
        ]);

        Staff::create($validatedData);
        return back()->with('success', 'Staff berhasil ditambahkan (Eloquent)');
    }

    public function updateEloquent(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_staff' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:staff,email,' . $id,
            'keterangan' => 'nullable|string'
        ]);

        $staff = Staff::findOrFail($id);
        $staff->update($validatedData);
        return back()->with('success', 'Staff berhasil diupdate (Eloquent)');
    }

    public function destroyEloquent($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        return back()->with('success', 'Staff berhasil dihapus (Eloquent)');
    }

    // --- QUERY BUILDER METHODS ---
    public function indexQueryBuilder()
    {
        $staffs = DB::table('staff')->orderBy('created_at', 'desc')->get();
        return view('staff.index', [
            'staffs' => $staffs,
            'type' => 'Query Builder'
        ]);
    }

    public function storeQueryBuilder(Request $request)
    {
        $validatedData = $request->validate([
            'nama_staff' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:staff,email',
            'keterangan' => 'nullable|string'
        ]);

        $validatedData['created_at'] = now();
        $validatedData['updated_at'] = now();

        DB::table('staff')->insert($validatedData);
        return back()->with('success', 'Staff berhasil ditambahkan (Query Builder)');
    }

    public function updateQueryBuilder(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_staff' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:staff,email,' . $id,
            'keterangan' => 'nullable|string'
        ]);

        $validatedData['updated_at'] = now();

        DB::table('staff')->where('id', $id)->update($validatedData);
        return back()->with('success', 'Staff berhasil diupdate (Query Builder)');
    }

    public function destroyQueryBuilder($id)
    {
        DB::table('staff')->where('id', $id)->delete();
        return back()->with('success', 'Staff berhasil dihapus (Query Builder)');
    }
}
