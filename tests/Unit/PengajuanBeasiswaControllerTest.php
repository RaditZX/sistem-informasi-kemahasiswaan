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

    // public function test_store_pengajuan_beasiswa_with_file_upload()
    // {
    //     $this->seed();

    //     // Simulate the file upload
    //     Storage::fake('gcs'); // Use a fake storage disk
    //     $file = UploadedFile::fake()->create('document.pdf', 100);

    //     // Mock the FileController's uploadFile method to return a fake URL
    //     $fileControllerMock = Mockery::mock(FileController::class);
    //     $fileControllerMock->shouldReceive('uploadFile')
    //         ->andReturn('https://firebasestorage.googleapis.com/v0/b/sistem-informasi-kemahasiswaan.appspot.com/o/uploads%2Fdocument.pdf?alt=media');

    //     // Bind the mocked instance in the application container
    //     $this->app->instance(FileController::class, $fileControllerMock);

    //     // Prepare the request data
    //     $data = [
    //         'nim' => '123456789',
    //         'beasiswa_id' => 1,
    //         'file' => $file,
    //     ];

    //     // Call the store method
    //     $response = $this->post(route('pengajuan.store'), $data);

    //     // Assert the redirect and success message
    //     $response->assertRedirect(route('pengajuan.create'));
    //     $response->assertSessionHas('success', 'Item created successfully.');

    //     // Assert that the data was inserted into the PengajuanBeasiswa table
    //     $this->assertDatabaseHas('pengajuan_beasiswa', [
    //         'nim' => '123456789',
    //         'beasiswa_id' => 1,
    //         'tanggal_pengajuan' => now()->toDateString(),
    //     ]);

    //     // Assert that the data was inserted into the PengajuanDokumen table
    //     $this->assertDatabaseHas('pengajuan_dokumen', [
    //         'nama_dokumen' => 'document.pdf',
    //         'link_dokumen' => 'https://firebasestorage.googleapis.com/v0/b/sistem-informasi-kemahasiswaan.appspot.com/o/uploads%2Fdocument.pdf?alt=media',
    //         'pengajuan_beasiswa_id' => PengajuanBeasiswa::first()->id,
    //     ]);

    //     // Assert the file was stored
    //     $this->assertTrue(Storage::disk('gcs')->exists('uploads/document.pdf')); // Updated path
    // }

    public function test_store_pengajuan_beasiswa_with_multiple_file_uploads_to_firestorage()
    {
        $this->seed();

        // Simulate the file upload
        Storage::fake('gcs'); // Use a fake storage disk

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
        $response = $this->post(route('pengajuan.store'), $data);

        // Assert the redirect and success message
        $response->assertRedirect(route('pengajuan.create'));
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
        $this->post(route('pengajuan.store'), $data);

        $response = $this->patch(route('pengajuan.edit', ['id' => 2]), [
            'file_1' => UploadedFile::fake()->create('new_document.pdf', 100),
        ]);

        $response->assertRedirect(route('pengajuan.create'));
        $response->assertSessionHas('success', 'Documents updated successfully.');
    }

    // public function testEditHandlesNoDocumentsFound()
    // {
    //     // Act: Simulate a request to edit with no documents
    //     $response = $this->post(route('pengajuan.edit', ['id' => '999']), [
    //         'title' => 'Updated Title',
    //         'status' => 'Updated Status',
    //     ]);

    //     $response->assertRedirect(route('pengajuan.create'));
    //     $this->assertSessionHas('failed', 'No documents found for pengajuan id: 999');
    // }




}
