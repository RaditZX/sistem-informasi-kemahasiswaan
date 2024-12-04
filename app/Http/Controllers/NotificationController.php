<?php

namespace App\Http\Controllers;
// NotificationController.php
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotifData()
{
    try {
        // Get all notifications
        $notifikasi = Notifikasi::all();
        // dd($notifikasi);
        // Return the notifications as JSON
        return $notifikasi;


    } catch (\Exception $e) {
        // Log the error and return an internal server error response
        \Log::error('Error fetching notifications: ' . $e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}

