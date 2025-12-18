<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        $brandModel = [
            'Toyota' => ['Avanza', 'Innova', 'Fortuner'],
            'Honda'  => ['Brio', 'Jazz', 'CR-V'],
            'Suzuki' => ['Ertiga', 'XL7'],
            'Mitsubishi' => ['Xpander', 'Pajero'],
        ];

        $brand = $this->faker->randomElement(array_keys($brandModel));
        $model = $this->faker->randomElement($brandModel[$brand]);

        return [
            'kode_mobil' => 'CAR-' . strtoupper($this->faker->unique()->bothify('###??')),
            'brand' => $brand,
            'model' => $model,
            'tahun' => $this->faker->year(),
            'no_polisi' => strtoupper($this->faker->bothify('B #### ??')),
            'warna' => $this->faker->optional()->safeColorName(),
            'kapasitas' => $this->faker->numberBetween(2, 8),
            'status_aktif' => 1,
        ];
    }
}
