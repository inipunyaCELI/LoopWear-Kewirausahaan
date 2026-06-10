<?php

namespace App\Http\Controllers;
use App\Models\Voucher;
use Illuminate\Http\Request;
class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::latest()->get();
        return view('admin.vouchers.index', compact('vouchers'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kode'                 => 'required|unique:vouchers,kode',
            'tipe'                 => 'required|in:persen,nominal,gratis_ongkir',
            'nilai'                => $request->tipe === 'gratis_ongkir' ? 'nullable|numeric|min:0' : 'required|numeric|min:0',
            'min_belanja'          => 'nullable|numeric|min:0',
            'kuota'                => 'nullable|integer|min:1',
            'berlaku_hingga'       => 'nullable|date',
            'khusus_pengguna_baru' => 'nullable|boolean', 
        ]);
        Voucher::create([
            'kode'                 => strtoupper($request->kode),
            'tipe'                 => $request->tipe,
            'nilai'                => $request->tipe === 'gratis_ongkir' ? 0 : $request->nilai,
            'min_belanja'          => $request->min_belanja ?? 0,
            'kuota'                => $request->kuota ?: null,
            'berlaku_hingga'       => $request->berlaku_hingga ?: null,
            'aktif'                => true,
            'khusus_pengguna_baru' => $request->has('khusus_pengguna_baru'), 
        ]);
        return back()->with('success', 'Voucher berhasil ditambahkan!');
    }
    public function toggle($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->update(['aktif' => !$voucher->aktif]);
        return back()->with('success', 'Status voucher diperbarui.');
    }
    public function destroy($id)
    {
        Voucher::findOrFail($id)->delete();
        return back()->with('success', 'Voucher berhasil dihapus.');
    }
}