<?php

namespace App\Http\Controllers;
// NotificationController.php
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;



class NotificationController extends Controller
{
    public function getNotifData()
{
    try {
        // Get all notifications
        $notifikasi = Notifikasi::where('user_id', auth()->id())  // Filter berdasarkan user_id
                                    ->with('pengajuanBeasiswa.Beasiswa', 'pengajuanBeasiswa.Status') // Eager load relasi untuk menghindari N+1 query
                                    ->get();
        // dd($notifikasi);
        // Return the notifications as JSON
        return $notifikasi;


    } catch (\Exception $e) {
        // Log the error and return an internal server error response
        Log::error('Error fetching notifications: ' . $e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}
