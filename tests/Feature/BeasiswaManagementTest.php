<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Beasiswa;
use App\Models\User;

class BeasiswaManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_beasiswa()
    {
        // Create a user
        $user = User::factory()->create();

        // Create some Beasiswa records
        Beasiswa::factory(5)->create();

        // Act as the user
        $this->actingAs($user);

        // Call the index route
        $response = $this->get(route('beasiswa.index'));

        // Assert the response is successful and beasiswa data is available
        $response->assertStatus(200);
        $response->assertViewHas('beasiswa');
    }
        /** @test */
    public function it_can_create_a_beasiswa()
    {
        // Create a user
        $user = User::factory()->create();

        // Act as the user
        $this->actingAs($user);

        // Post request to store beasiswa
        $response = $this->post(route('beasiswa.store'), [
            'nama_beasiswa' => 'Test Beasiswa',
            'deskripsi' => 'This is a test beasiswa.',
            'jenis_beasiswa' => 'full',
            'tipe_beasiswa' => 'prestasi',
            'kuota_beasiswa' => 50,
            'sumber_beasiswa' => 'Government',
            'tanggal_mulai' => '2024-01-01',
            'tanggal_berakhir' => '2024-12-31',
            'syarat_beasiswa' => ['Essay', 'Transcript'],
            'benefit_beasiswa' => ['Tuition Fee', 'Monthly Allowance'],
            'jenjang_pendidikan' => ['Undergraduate', 'Postgraduate'],
        ]);

        // Assert redirect after successful creation
        $response->assertRedirect('/form-beasiswa');

        // Assert the beasiswa is stored in the database
        $this->assertDatabaseHas('beasiswa', ['nama_beasiswa' => 'Test Beasiswa']);
    }

    /** @test */
    public function it_can_show_a_specific_beasiswa()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a Beasiswa
        $beasiswa = Beasiswa::factory()->create();

        // Act as the user
        $this->actingAs($user);

        // Call the show route
        $response = $this->get(route('beasiswa.show', $beasiswa->id));

        // Assert the response contains the beasiswa data
        $response->assertStatus(200);
        $response->assertViewHas('beasiswa');
    }

    /** @test */
    public function it_can_delete_a_beasiswa()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a Beasiswa
        $beasiswa = Beasiswa::factory()->create();

        // Act as the user
        $this->actingAs($user);

        // Call the destroy route
        $response = $this->delete(route('beasiswa.destroy', $beasiswa->id));

        // Assert redirect after deletion
        $response->assertRedirect(route('beasiswa.index'));

        // Assert the beasiswa is deleted from the database
        $this->assertDatabaseMissing('beasiswa', ['id' => $beasiswa->id]);
    }

}
