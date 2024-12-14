<?php

namespace Tests\Unit;

use App\Models\PengajuanBeasiswa;
use App\Models\PengajuanDokumen;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PengajuanBeasiswaControllerTest extends TestCase
{
    use RefreshDatabase;


    public function test_store_pengajuan_beasiswa_with_multiple_file_uploads_to_firestorage()
    {

        $this->seed(); // Seed the database, if needed

        // Simulate the file upload using fake storage
        Storage::fake('gcs');

        // Prepare the request data with multiple files
        $files = [
            UploadedFile::fake()->create('document1.pdf', 100),
            UploadedFile::fake()->create('document2.pdf', 100),
            UploadedFile::fake()->create('document3.pdf', 100),
            UploadedFile::fake()->create('document4.pdf', 100),
            UploadedFile::fake()->create('document5.pdf', 100),
        ];

        // Prepare the request data
        $data = [
            'nim' => '123456789',
            'beasiswa_id' => 1,
            'file_1' => $files[0],
            'file_2' => $files[1],
            'file_3' => $files[2],
            'file_4' => $files[3],
            'file_5' => $files[4],
        ];

        // Call the store method
        $response = $this->post(route('pengajuan.store', ['id' => 1]), $data);

        // Assert the redirect and success message
        $response->assertRedirect(route('pengajuan.create', ['id' => 1]));
        $response->assertSessionHas('success', 'Item created successfully.');

        // Assert that the data was inserted into the PengajuanBeasiswa table
        $this->assertDatabaseHas('pengajuan_beasiswa', [
            'nim' => '123456789',
            'beasiswa_id' => 1,
            'tanggal_pengajuan' => now()->toDateString(),
        ]);

        // Assert that each document was inserted into the PengajuanDokumen table
        foreach ($files as $file) {
            $this->assertDatabaseHas('pengajuan_dokumen', [
                'nama_dokumen' => $file->getClientOriginalName(),
                'link_dokumen' => 'https://firebasestorage.googleapis.com/v0/b/sistem-informasi-kemahasiswaan.appspot.com/o/dokumen%2F' . $file->getClientOriginalName() . '?alt=media',
                'pengajuan_beasiswa_id' => PengajuanBeasiswa::first()->id,
            ]);
        }
    }


    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('dokumen');
    }

    public function testEditUpdatesDocumentsSuccessfully()
    {
        $this->seed();

        $files = [
            UploadedFile::fake()->create('document1.pdf', 100),
            UploadedFile::fake()->create('document2.pdf', 100),
            UploadedFile::fake()->create('document3.pdf', 100),
            UploadedFile::fake()->create('document4.pdf', 100),
            UploadedFile::fake()->create('document5.pdf', 100),
        ];

        $data = [
            'nim' => '123456789',
            'beasiswa_id' => 11,
            'file_1' => $files[0],
            'file_2' => $files[1],
            'file_3' => $files[2],
            'file_4' => $files[3],
            'file_5' => $files[4],
        ];

        // Call the store method
        $this->post(route('pengajuan.store', ["id" => 11]), $data);

        // Edit test: update document
        $response = $this->patch(route('pengajuan.edit', ['id' => 2]), [
            'file_1' => UploadedFile::fake()->create('new_document.pdf', 100),
        ]);

        // Pass the correct id for the redirect route
        $response->assertRedirect(route('pengajuan.create', ['id' => 2]));
        $response->assertSessionHas('success', 'Documents updated successfully.');
    }




}
