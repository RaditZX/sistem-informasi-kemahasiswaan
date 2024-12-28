<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        $user = Auth::user();
        $user_img = $user->foto;
        $email = $user->email;
        $jk = $user->jenis_kelamin;

        $nama = explode(' ', $user->name);
        $nama_depan = $nama[0];
        $nama_belakang = $nama[1];
        $notifController = new NotificationController();
        $notificationData = $notifController->getNotifData();

        return view('pages.Pengaturan.index', compact('user_id', 'email', 'nama_depan', 'nama_belakang', 'jk', 'user_img', 'notificationData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect('login');
        }

        // Validate the uploaded file
        $request->validate([
            'new_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate file type and size
        ]);

        // Check if a new image is uploaded
        if ($request->hasFile('new_img')) {
            // Store the new image in the 'public/assets/img' directory
            $new_img_path = $request->file('new_img')->store('assets/img', 'public');

            // Update the user's 'foto' field with the new image path
            User::where('id', $id)
                ->update([
                    'foto' => $new_img_path
                ]);

            return redirect()->route('pengaturan.index')->with('success', 'Profile updated successfully');
        }

        return redirect()->route('pengaturan.index')->with('error', 'Failed to update profile photo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
