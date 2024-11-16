<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $notifController = new NotificationController();
        $notificationData = $notifController->getNotifData();

        return view('pages.Beasiswa.dashboard', compact('notificationData'));
    }

}
