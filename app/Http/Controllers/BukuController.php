<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Models\Buku;
use Exception;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statusQuery = $request->query('status');
        if ($statusQuery) {
            $peminjamans = Buku::where('status', $statusQuery)->get();
        } else {
            $peminjamans = Buku::all();
        }

        if ($peminjamans) {
            return ApiFormatter::createApi(200, 'success', $peminjamans);
        } else {
            return ApiFormatter::createApi(400, 'failed');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required',
                'nama_peminjam' => 'required',
                'tanggal_pinjam' => 'required',
                'tanggal_kembali' => 'required',
                'status' => 'required',
            ],
            [
                'judul.required' => 'Judul buku harus diisi',
                'nama_peminjam.required' => 'Nama peminjam harus diisi',
                'tanggal_pinjam.required' => 'Tanggal pinjam harus diisi',
                'tanggal_kembali.required' => 'Tanggal kembali harus diisi',
                'status.required' => 'Status harus diisi',
            ]);

            $peminjaman = Buku::create([
                'judul' => $request->judul,
                'nama_peminjam' => $request->nama_peminjam,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status' => $request->status,
            ]);

            $getPeminjaman = Buku::find($peminjaman->id);

            if ($getPeminjaman) {
                return ApiFormatter::createApi(200, 'success', $getPeminjaman);
            } else {
                return ApiFormatter::createApi(400, 'failed');
            }

        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'failed', $error->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $peminjaman = Buku::find($id);
            if ($peminjaman) {
                return ApiFormatter::createApi(200, 'success', $peminjaman);
            } else {
                return ApiFormatter::createApi(400, 'failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'failed', $error->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'judul' => 'required',
                'nama_peminjam' => 'required',
                'tanggal_pinjam' => 'required',
                'tanggal_kembali' => 'required',
                'status' => 'required',
            ],
            [
                'judul.required' => 'Judul buku harus diisi',
                'nama_peminjam.required' => 'Nama peminjam harus diisi',
                'tanggal_pinjam.required' => 'Tanggal pinjam harus diisi',
                'tanggal_kembali.required' => 'Tanggal kembali harus diisi',
                'status.required' => 'Status harus diisi',
            ]);

            $peminjaman = Buku::find($id);
            $peminjaman->update([
                'judul' => $request->judul,
                'nama_peminjam' => $request->nama_peminjam,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status' => $request->status,
            ]);

            $getPeminjaman = Buku::find($peminjaman->id);
            if ($getPeminjaman) {
                return ApiFormatter::createApi(200, 'success', $getPeminjaman);
            } else {
                return ApiFormatter::createApi(400, 'failed');
            }

        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'failed', $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $peminjaman = Buku::find($id);
            $validation = $peminjaman->delete();

            if ($validation) {
                return ApiFormatter::createApi(200, 'success', 'Data Terhapus');
            } else {
                return ApiFormatter::createApi(400, 'failed');
            }

        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'failed', $error->getMessage());
        }
    }
}
