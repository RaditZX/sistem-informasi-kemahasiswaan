<?php

namespace Database\Factories;

use App\Models\Beasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class BeasiswaFactory extends Factory
{
    protected $model = Beasiswa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_beasiswa' => $this->faker->word() . ' Scholarship',
            'deskripsi' => $this->faker->paragraphs(5, true), // Menghasilkan 3 kalimat,
            'sumber' => $this->faker->word(),
            'kuota' => $this->faker->numberBetween(1, 100),
            'jenis_beasiswa' => $this->faker->randomElement(['full', 'setengah']),
            'tipe_beasiswa' => $this->faker->randomElement(['prestasi', 'ekonomi', 'eksternal']),
            'tanggal_mulai' => $this->faker->date(),
            'tanggal_berakhir' => $this->faker->date(),
        ];
    }
}
