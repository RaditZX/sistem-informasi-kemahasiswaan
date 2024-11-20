<?php

// tests/Feature/RegisterTest.php
namespace Tests\Feature;

use App\Models\User;
use App\Services\FirebaseAuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Kreait\Firebase\Exception\Auth\EmailExists as FirebaseEmailExists;
use Mockery;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_user_with_email_and_password_method()
    {
        // Prepare mock data
        $email = 'muhammad.raihan.tif23@polban.ac.id';
        $password = 'password123';

        // Mock FirebaseAuth
        $firebaseAuth = Mockery::mock(FirebaseAuthService::class);

        // Mock createUserWithEmailAndPassword method to return a fake user object
        $firebaseAuth->shouldReceive('createUserWithEmailAndPassword')
            ->with($email, $password);

        // Bind the mock FirebaseAuth instance to the app container
        $this->app->instance(FirebaseAuthService::class, $firebaseAuth);

        // Simulate sending a POST request to register the user
        $response = $this->post('/register', [
            'method' => 'email_password',
            'email' => $email,
            'password' => $password,
        ]);


        // Assert the response status and content
        $response->assertStatus(201)
            ->assertJson([
                'message' => 'User registered successfully',
                'user' => ['email' => $email]
            ]);

        // Assert that the user was created in the database
        $this->assertDatabaseHas('users', [
            'email' => $email
        ]);
    }



    /** @test */
    public function it_returns_error_if_email_already_exists()
    {
        // Mock FirebaseAuth
        $firebaseAuth = Mockery::mock(FirebaseAuthService::class);

        // Simulate the userExists method returning true for an existing user
        $firebaseAuth->shouldReceive('userExists')
            ->with('existinguser@polban.ac.id')
            ->andReturn(true);

        // Ensure createUserWithEmailAndPassword is never called for an existing user
        $firebaseAuth->shouldNotReceive('createUserWithEmailAndPassword');

        // Bind the mock to the app container
        $this->app->instance(FirebaseAuthService::class, $firebaseAuth);

        // Attempt to register with an existing email
        $response = $this->post('/register', [
            'method' => 'email_password',
            'email' => 'existinguser@polban.ac.id',
            'password' => 'secret',
        ]);

        // Assert the correct error response
        $response->assertStatus(409)
            ->assertJson(['error' => 'Email already exists in Firebase']);
    }
    /** @test */
    public function it_can_insert_mahasiswa_data()
    {
        $this->seed();

        // Define request data
        $data = [
            'nim' => '123456782',
            'semester' => 3,
            'tgl_lahir' => '2001-01-01',
            'prodi_id' => 1, // Ensure this exists in 'prodi' table or use a factory to create it
            'no_hp' => '081234567890',
            'angkatan' => 2021,
        ];

        // Make the post request
        $response = $this->post(route('mahasiswa.insert', ['id'=>1]), $data);

        // Assert that the response is successful
        $response->assertStatus(201)
            ->assertJson(['message' => 'Mahasiswa created successfully.']);

        // Assert that the Mahasiswa record exists in the database
        $this->assertDatabaseHas('mahasiswa', [
            'user_id' => 1,
            'nim' => '123456782',
            'semester' => 3,
            'tgl_lahir' => '2001-01-01',
            'prodi_id' => 1,
            'no_hp' => '081234567890',
            'angkatan' => 2021,
        ]);
    }
}
