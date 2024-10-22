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
            'nama_beasiswa' => 'LKPD'. ' Scholarship',
            'deskripsi' => 'Beasiswa LPDP adalah program beasiswa yang dibiayai oleh pemerintah, dan dikelola oleh LPDP (Lembaga Pengelola Dana Pendidikan). Beasiswa LPDP ini diberikan khusus kepada mereka yang ingin melanjutkan pendidikan ke jenjang magister (S2) atau doktor (S3).', // Menghasilkan 3 kalimat,
            'sumber' => 'KEMENDIKBUD',
            'tipe_beasiswa' => $this->faker->randomElement([
                'prestasi', 
                'ekonomi', 
                'eksternal', 
            ]),
            'jenis_waktu_beasiswa' => $this->faker->randomElement([
                'last', 
                'current', 
                'upcoming', 
            ]),
            'kuota' => $this->faker->numberBetween(1, 100),
            'jenis_beasiswa' => $this->faker->randomElement(['full', 'setengah']),
            'tipe_beasiswa' => $this->faker->randomElement(['ekonomi','prestasi','external']),
            'tanggal_mulai' => $this->faker->date(),
            'tanggal_berakhir' => $this->faker->date(),
        ];
    }
}
