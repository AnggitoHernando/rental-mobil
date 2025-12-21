<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarPrice;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = Car::query()
            ->filter($request)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Cars/Cars', [
            'items' => $items,
            'filters' => $request->only([
                'search',
                'sort',
                'direction',
                'from',
                'to',
            ])
        ]);
    }


    public function getImage(Car $car)
    {
        $result = $car->load('images');
        $images = $result->images;
        $cover = $car->load('imageCover')->imageCover;
        return response()->json([
            'images' => $images,
            'coverImage' => $cover
        ]);
    }

    public function getPrice(Car $car)
    {
        $result = $car->load('prices');
        $price = $result->prices;
        return response()->json([
            'price' => $price
        ]);
    }

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
                    'min:1901',
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
    public function storeImage(Request $request, ImageService $imageService)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'images' => 'required|array|min:1',
            'images.*.image_path' => 'file|image|mimes:jpg,jpeg,png,webp',
            'images.*.cover' => 'required|in:0,1',
        ]);
        $car = Car::findOrFail($validated['car_id']);
        if ($request->hasFile('images.0.image_path')) {
            foreach ($request->images as $index => $item) {
                $file  = $request->file("images.$index.image_path");
                $cover = $item['cover'];
                $galleryImage =  $imageService->resizeToJpeg(
                    $file,
                    1200,
                    800
                );
                $galleryPath = 'mobil/galeri/' . uniqid() . '.jpg';
                Storage::disk('public')->put($galleryPath, $galleryImage);
                $car->images()->create([
                    'image_path' => $galleryPath,
                    'cover' => $cover
                ]);
            }
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Gambar berhasil disimpan',
        ]);
    }

    public function storePrice(Request $request)
    {
        $validated = $request->validate(
            [
                'car_id' => 'required|exists:cars,id',
                'price_type' => [
                    'required',
                    Rule::in(['harian', 'mingguan', 'bulanan']),
                    Rule::unique('car_prices', 'price_type')
                        ->where(fn($q) => $q->where('car_id', $request->car_id)),
                ],
                'bruto' => ['required', 'numeric', 'min:1'],
                'disc'  => ['required', 'numeric', 'min:0', 'max:100'],
                'netto'  => ['required', 'numeric', 'min:1'],
            ],
            [
                'required' => 'Kolom :attribute wajib diisi',
                'unique' => ':attribute sudah terdaftar',
                'exists' => ':attribute tidak terdaftar',
                'min' => ':attribute terlalu kecil min :min',
                'max' => ':attribute terlalu besar maksimal :max',
                'numeric' => ':attribute harus berupa angka',
                'price_type.unique' => ':attribute ini sudah tersedia.',
            ],
            [
                'bruto' => 'Bruto',
                'car_id' => 'Mobil',
                'disc' => 'Diskon',
                'price_type' => 'Jenis Harga',
                'netto' => 'Netto',
            ]
        );
        $car = Car::findOrFail($validated['car_id']);

        $car->prices()->create([
            'price_type' => $validated['price_type'],
            'bruto'      => $validated['bruto'],
            'disc'       => $validated['disc'],
            'netto'      => $validated['netto'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Harga berhasil disimpan',
        ]);
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

    public function destroyPrice(CarPrice $price)
    {
        $price->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data Berhasil Dihapus',
        ]);
    }
}
