<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Cars/Cars', [
            'items' => Car::latest()->paginate(10),
            'filters' => $request->only(['search', 'sort', 'direction']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'kode_mobil' => 'required|unique:cars,kode_mobil',
                'brand'      => 'required',
                'model'      => 'required',
                'tahun' => [
                    'required',
                    'integer',
                    'min:1700',
                    'max:' . now()->year,
                ],
                'kapasitas'  => [
                    'required',
                    'integer',
                    'min:0',
                ],
                'no_polisi'  => 'required|unique:cars,no_polisi',
                'warna'      => 'required',
            ],
            [
                'required' => 'Kolom :attribute wajib diisi',
                'unique' => ':attribute sudah terdaftar',
                'min' => ':attribute terlalu kecil min :min',
                'max' => ':attribute terlalu besar maksimal :max',
            ],
            [
                'kode_mobil' => 'Kode Mobil',
                'brand' => 'Brand',
                'model' => 'Model',
                'no_polisi' => 'Nomor Polisi',
                'tahun' => 'Tahun Mobil',
                'warna' => 'Warna',
                'kapasitas' => 'Kapasitas',
            ]
        );

        Car::create($validated);

        return redirect()->back()->with('success', 'Mobil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate(
            [
                'kode_mobil' => [
                    'required',
                    Rule::unique('cars', 'kode_mobil')->ignore($car->id),
                ],
                'brand'      => 'required',
                'model'      => 'required',
                'tahun' => [
                    'required',
                    'integer',
                    'min:1700',
                    'max:' . now()->year,
                ],
                'kapasitas'  => [
                    'required',
                    'integer',
                    'min:0',
                ],
                'no_polisi'  => [
                    'required',
                    Rule::unique('cars', 'no_polisi')->ignore($car->id),
                ],
                'warna'      => 'required',
            ],
            [
                'required' => 'Kolom :attribute wajib diisi',
                'unique' => ':attribute sudah terdaftar',
                'min' => ':attribute terlalu kecil min :min',
                'max' => ':attribute terlalu besar maksimal :max',
            ],
            [
                'kode_mobil' => 'Kode Mobil',
                'brand' => 'Brand',
                'model' => 'Model',
                'no_polisi' => 'Nomor Polisi',
                'tahun' => 'Tahun Mobil',
                'warna' => 'Warna',
                'kapasitas' => 'Kapasitas',
            ]
        );

        $car->update($validated);

        return redirect()->back()->with('success', 'Mobil Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
