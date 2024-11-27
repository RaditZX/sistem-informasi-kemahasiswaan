<?php

namespace Tests\Feature;

use App\Models\Beasiswa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;

class BeasiswaManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_beasiswa()
    {


        // Create some Beasiswa records
        Beasiswa::factory(5)->create();

        // Call the index route
        $response = $this->get(route('beasiswa.index'));

        // Assert the response is successful and beasiswa data is available
        $response->assertStatus(200);
        $response->assertViewHas('beasiswa');
    }

    /** @test */
    /** @test */
    public function it_can_store_a_new_scholarship()
    {
        // Create a user and act as the user

        $file = UploadedFile::fake()->image('poster1.jpg');

        // Prepare the test data
        $data = [
            'nama_beasiswa' => 'Test Scholarship',
            'deskripsi' => 'A description for the test scholarship.',
            'jenis_beasiswa' => 'full',
            'tipe_beasiswa' => 'prestasi',
            'kuota_beasiswa' => 100,
            'sumber_beasiswa' => 'Test Source',
            'tanggal_mulai' => now()->addDays(10)->toDateString(), // 10 days in the future
            'tanggal_berakhir' => now()->addDays(20)->toDateString(), // 20 days in the future
            'file_1' => UploadedFile::fake()->image('poster1.jpg'),
            'file_2' => UploadedFile::fake()->image('poster2.jpg'),
            'file_3' => UploadedFile::fake()->image('poster3.jpg'),
            'syarat_beasiswa' => ['Esai', 'Transkrip Nilai'],
            'benefit_beasiswa' => ['Scholarship Fund', 'Networking Opportunities'],
            'jenjang_pendidikan' => ['Undergraduate'],
            'file_1' => $file
        ];

        // Simulate the file storage
        Storage::fake('gcs');

        // Send a POST request to the store method
        $response = $this->post('/beasiswa', $data);

        // Assert that the response is a redirect
        $response->assertRedirect('/beasiswa');

        // Assert that the scholarship was stored in the database
        $this->assertDatabaseHas('beasiswa', [
            'nama_beasiswa' => 'Test Scholarship',
            'deskripsi' => 'A description for the test scholarship.',
            'jenis_beasiswa' => 'full',
            'tipe_beasiswa' => 'prestasi',
            'kuota' => 100,
            'sumber' => 'Test Source',
        ]);

        // Check if the requirements are stored
        $this->assertDatabaseHas('syarat_beasiswa', [
            'syarat' => 'Esai',
        ]);

        $this->assertDatabaseHas('syarat_beasiswa', [
            'syarat' => 'Transkrip Nilai',
        ]);

        // Check if the benefits are stored
        $this->assertDatabaseHas('benefit_beasiswa', [
            'benefit' => 'Scholarship Fund',
        ]);

        // Check if the educational levels are stored
        $this->assertDatabaseHas('jenjang_pendidikan', [
            'jenjang' => 'Undergraduate',
        ]);
    }


    /** @test */
    public function it_can_show_a_specific_beasiswa()
    {

        // Create a Beasiswa
        $beasiswa = Beasiswa::factory()->create();


        // Call the show route
        $response = $this->get(route('beasiswa.show', $beasiswa->id));

        // Assert the response contains the beasiswa data
        $response->assertStatus(200);
        $response->assertViewHas('beasiswa');
    }

    /** @test */
    public function it_can_delete_a_beasiswa()
    {

        // Create a Beasiswa
        $beasiswa = Beasiswa::factory()->create();

        // Call the destroy route
        $response = $this->delete(route('beasiswa.destroy', $beasiswa->id));

        // Assert redirect after deletion
        $response->assertRedirect(route('beasiswa.index'));

        // Assert the beasiswa is deleted from the database
        $this->assertDatabaseMissing('beasiswa', ['id' => $beasiswa->id]);
    }

}
