<?php

namespace App\Http\Controllers;
// NotificationController.php
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function getNotifData()
{
    try {
        // Get all notifications
        return Notifikasi::all();

        // Return the notifications as JSON
    } catch (\Exception $e) {
        // Log the error and return an internal server error response
        Log::error('Error fetching notifications: ' . $e->getMessage());
        return response()->json(['error' => 'Unable to fetch notifications'], 500);
    }
}

}


