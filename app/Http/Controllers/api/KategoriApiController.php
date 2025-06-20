<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KategoriApiController extends Controller
{
    // Menambahkan middleware auth untuk semua method
    public function __construct()
    {
        $this->middleware('auth:sanctum'); // Menggunakan Laravel Sanctum
        // Atau bisa menggunakan: $this->middleware('auth:api'); untuk JWT
    }
   
    public function index()
    {
        try {
            $data = KategoriBarang::all();
            return response()->json([
                'success' => true,
                'message' => 'Data kategori berhasil diambil',
                'data' => $data
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $kategori = KategoriBarang::with('barangs')->find($id);

            if (!$kategori) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data kategori berhasil diambil',
                'data' => $kategori
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_kategori' => 'required|string|max:255|unique:kategori_barang,nama_kategori',
            ]);

            $kategori = KategoriBarang::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil ditambahkan',
                'data' => $kategori,
            ], Response::HTTP_CREATED);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan kategori',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $kategori = KategoriBarang::find($id);

            if (!$kategori) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            $validated = $request->validate([
                'nama_kategori' => 'required|string|max:255|unique:kategori_barang,nama_kategori,' . $id,
            ]);

            $kategori->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil diperbarui',
                'data' => $kategori,
            ], Response::HTTP_OK);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui kategori',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $kategori = KategoriBarang::find($id);

            if (!$kategori) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            $kategori->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil dihapus'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus kategori',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}