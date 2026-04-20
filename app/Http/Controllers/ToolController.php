<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Helpers\ActivityHelper;
use Illuminate\Http\Request;

class ToolController extends Controller
{
  public function index(Request $request)
{
    $query = Tool::with('category');

    // 🔍 Search (nama alat / merk / kode)
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('nama_alat', 'like', '%' . $request->search . '%')
              ->orWhere('merk', 'like', '%' . $request->search . '%')
              ->orWhere('kode_alat', 'like', '%' . $request->search . '%');
        });
    }

    // 🏷️ Filter kategori
    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    $tools = $query->latest()->get();

    // ambil kategori untuk dropdown
    $categories = \App\Models\Category::all();

    return view('tools.index', compact('tools', 'categories'));
}

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('tools.create', compact('categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_alat' => 'required',
        'merk' => 'required',
        'lokasi' => 'required',
        'kondisi' => 'required',
        'stok' => 'required|integer',
        'category_id' => 'required'
    ]);

    // Ambil kategori
    $category = \App\Models\Category::findOrFail($request->category_id);

    // Ambil inisial kategori (contoh: Laptop Komputer → LK)
    $prefix = collect(explode(' ', $category->nama_kategori))
        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
        ->implode('');

    // Hitung jumlah alat dengan kategori yang sama
    $count = Tool::where('category_id', $category->id)->count() + 1;

    $lastTool = Tool::where('category_id', $category->id)->latest()->first();
    $number = $lastTool ? ((int) substr($lastTool->kode_alat, -3)) + 1 : 1;

    // Format nomor (001, 002, dst)
    $kode_alat = $prefix . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

    // Simpan data
    $tool = Tool::create([
        ...$request->all(),
        'kode_alat' => $kode_alat
    ]);

    ActivityHelper::log('CREATE_ALAT', "Tambah alat: {$tool->nama_alat}");

    return redirect()->route('tools.index')->with('success', 'Alat berhasil ditambahkan');
}

    public function edit($id)
    {
        $tool = Tool::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('tools.edit', compact('tool', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_alat' => 'required',
            'merk' => 'required',
            'lokasi' => 'required',
            'kondisi' => 'required',
            'stok' => 'required|integer',
            'category_id' => 'required'
        ]);

        $tool = Tool::findOrFail($id);

        // Ambil kategori baru
        $category = \App\Models\Category::findOrFail($request->category_id);

        // Ambil prefix dari kategori
        $prefix = collect(explode(' ', $category->nama_kategori))
            ->map(fn($word) => strtoupper(substr($word, 0, 1)))
            ->implode('');

        // Ambil data terakhir di kategori (kecuali data ini sendiri)
        $lastTool = Tool::where('category_id', $category->id)
            ->where('id', '!=', $tool->id)
            ->orderBy('id', 'desc')
            ->first();

        $number = $lastTool 
            ? ((int) substr($lastTool->kode_alat, -3)) + 1 
            : 1;

        $kode_alat = $prefix . '-' . str_pad($number, 3, '0', STR_PAD_LEFT);

        // Update data
        $tool->update([
            ...$request->all(),
            'kode_alat' => $kode_alat
        ]);

        ActivityHelper::log('UPDATE_ALAT', "Edit alat: {$tool->nama_alat}");

        return redirect()->route('tools.index')->with('success', 'Alat berhasil diperbarui');
    }

    public function destroy($id)
    {
        $tool = Tool::findOrFail($id);
        $nama_alat = $tool->nama_alat;
        $tool->delete();
        
        // Catat aktivitas
        ActivityHelper::log('DELETE_ALAT', "Hapus alat: {$nama_alat}");

        return redirect()->route('tools.index')->with('success', 'Alat berhasil dihapus');
    }
}
