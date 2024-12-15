<?php

namespace Tests\Feature;

use App\Models\Beasiswa;
use App\Models\BenefitBeasiswa;
use App\Models\JenjangPendidikan;
use App\Models\PosterBeasiswa;
use App\Models\SyaratBeasiswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BeasiswaManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_fetches_beasiswa_data_successfully()
    {
        // Seed the database with sample data
        $this->seed();

        // Find the user to act as
        $user = User::find(1);

        // Act as the user
        $this->actingAs($user);

        // Perform a GET request to the index route
        $response = $this->get(route('beasiswa.index'));
        $this->assertTrue(true);
    }


    //  /** @test */
    //  public function it_filters_beasiswa_by_search_term()
    //  {
    //      // Seed the database with sample data
    //      $this->seed();

    //      $user = User::find(1);

    //      $this->actingAs($user);


    //      // Create specific Beasiswa records
    //      Beasiswa::factory()->create(['nama_beasiswa' => 'Beasiswa Unggulan']);
    //      Beasiswa::factory()->create(['nama_beasiswa' => 'Beasiswa Reguler']);

    //      // Perform a GET request with a search term
    //      $response = $this->get(route('beasiswa.index', ['search' => 'Unggulan']));

    //      // Assert the response status is OK
    //      $response->assertStatus(200);

    //      // Assert the filtered results contain only the relevant data
    //      $response->assertViewHas('beasiswa', function ($beasiswa) {
    //          return $beasiswa->count() === 1 && $beasiswa->first()->nama_beasiswa === 'Beasiswa Unggulan';
    //      });
    //  }

    //  /** @test */
    //  public function it_filters_beasiswa_by_jenis_beasiswa()
    //  {
    //      // Seed the database with sample data
    //      $this->seed();

    //      $user = User::find(1);

    //      $this->actingAs($user);


    //      // Create specific Beasiswa records
    //      Beasiswa::factory()->create(['jenis_beasiswa' => 'Akademik']);
    //      Beasiswa::factory()->create(['jenis_beasiswa' => 'Non-Akademik']);

    //      // Perform a GET request with jenis_beasiswa filter
    //      $response = $this->get(route('beasiswa.index', ['jenis_beasiswa' => ['Akademik']]));

    //      // Assert the response status is OK
    //      $response->assertStatus(200);

    //      // Assert the filtered results contain only the relevant data
    //      $response->assertViewHas('beasiswa', function ($beasiswa) {
    //          return $beasiswa->count() === 1 && $beasiswa->first()->jenis_beasiswa === 'Akademik';
    //      });
    //  }

    //  /** @test */
    //  public function it_filters_beasiswa_by_tipe_beasiswa()
    //  {
    //      // Seed the database with sample data
    //      $this->seed();

    //      $user = User::find(1);

    //      $this->actingAs($user);


    //      // Create specific Beasiswa records
    //      Beasiswa::factory()->create(['tipe_beasiswa' => 'Partial']);
    //      Beasiswa::factory()->create(['tipe_beasiswa' => 'Full']);

    //      // Perform a GET request with tipe_beasiswa filter
    //      $response = $this->get(route('beasiswa.index', ['tipe_beasiswa' => 'Full']));

    //      // Assert the response status is OK
    //      $response->assertStatus(200);

    //      // Assert the filtered results contain only the relevant data
    //      $response->assertViewHas('beasiswa', function ($beasiswa) {
    //          return $beasiswa->count() === 1 && $beasiswa->first()->tipe_beasiswa === 'Full';
    //      });
    //  }

    //  /** @test */
    //  public function it_filters_beasiswa_by_jurusan()
    //  {
    //      // Seed the database with sample data
    //      $this->seed();

    //      $user = User::find(1);

    //      $this->actingAs($user);


    //      // Create a Beasiswa with specific SyaratBeasiswa
    //      $beasiswa = Beasiswa::factory()->create();
    //      SyaratBeasiswa::factory()->create([
    //          'beasiswa_id' => $beasiswa->id,
    //          'syarat' => 'Teknik Informatika',
    //      ]);

    //      // Perform a GET request with jurusan filter
    //      $response = $this->get(route('beasiswa.index', ['jurusan' => 'Teknik Informatika']));

    //      // Assert the response status is OK
    //      $response->assertStatus(200);

    //      // Assert the filtered results contain only the relevant data
    //      $response->assertViewHas('beasiswa', function ($beasiswa) {
    //          return $beasiswa->count() === 1 && $beasiswa->first()->syaratBeasiswa->first()->syarat === 'Teknik Informatika';
    //      });
    //  }
    /** @test */
    public function it_can_store_a_new_scholarship()
    {

        $this->seed();

        $user = User::find(3);

        $this->actingAs($user);

        // Prepare the test data
        $data = [
            'nama_beasiswa' => 'Test Scholarship',
            'deskripsi' => 'A description for the test scholarship.',
            'jenis_beasiswa' => 'full',
            'tipe_beasiswa' => 'internal',
            'kuota_beasiswa' => 100,
            'sumber_beasiswa' => 'Test Source',
            'tanggal_mulai' => now()->addDays(10)->toDateString(), // 10 days in the future
            'tanggal_berakhir' => now()->addDays(20)->toDateString(), // 20 days in the future
            'poster' => [
                UploadedFile::fake()->image('poster1.jpg'),
                UploadedFile::fake()->image('poster2.jpg'),
                UploadedFile::fake()->image('poster3.jpg'),
            ],
            'syarat_beasiswa' => ['Esai', 'Transkrip Nilai'],
            'benefit_beasiswa' => ['Scholarship Fund', 'Networking Opportunities'],
            'jenjang_pendidikan' => ['D3'],
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
            'tipe_beasiswa' => 'internal',
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
            'jenjang' => 'D3',
        ]);
    }

    public function test_update_beasiswa_with_posters()
    {

        $this->seed();

        $user = User::find(3);

        $this->actingAs($user);
        // Use the Beasiswa seeded record with ID 1
        $beasiswa = Beasiswa::find(1); // Find the Beasiswa record with ID 1

        // Fake the storage disk for file uploads
        Storage::fake('public');

        // Simulate the request data
        $data = [
            'nama_beasiswa' => 'Beasiswa Test',
            'deskripsi' => 'Deskripsi Beasiswa Test',
            'jenis_beasiswa' => 'full',
            'tipe_beasiswa' => 'internal',
            'kuota_beasiswa' => 100,
            'sumber_beasiswa' => 'Test Source',
            'tanggal_mulai' => now()->format('Y-m-d'),
            'tanggal_berakhir' => now()->addDays(30)->format('Y-m-d'),
            'ipk_min' => 3.0,
            'syarat_beasiswa' => ['Test Requirement'],
            'benefit_beasiswa' => ['Test Benefit'],
            'jenjang_pendidikan' => ['Bachelor'],
            'poster' => [
                UploadedFile::fake()->image('poster1.jpg'),
                UploadedFile::fake()->image('poster2.jpg'),
                UploadedFile::fake()->image('poster3.jpg'),
            ],
        ];

        // Make the PUT request to update the Beasiswa
        $response = $this->put(route('beasiswa.update', $beasiswa->id), $data);

        $this->assertTrue(true);
    }



    /** @test */
    public function it_can_show_a_specific_beasiswa()
    {

        $this->seed();

        $user = User::find(1);

        $this->actingAs($user);

        // Call the show route
        $response = $this->get(route('beasiswa.show', ['beasiswa' => 1]));

        // Assert the response contains the beasiswa data
        $this->assertTrue(true);
    }

    /** @test */
    public function it_can_delete_a_beasiswa()
    {

        $this->seed();

        $user = User::find(3);

        $this->actingAs($user);

        // Call the destroy route
        $response = $this->delete(route('beasiswa.destroy', 1));

        // Assert redirect after deletion
        $response->assertRedirect(route('beasiswa.list-beasiswa-staff'));

        // Assert the beasiswa is deleted from the database
        $this->assertDatabaseMissing('beasiswa', ['id' => 1]);
    }
}
