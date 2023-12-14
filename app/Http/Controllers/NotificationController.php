<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\notification;
class NotificationController extends Controller
{
    public function markAsRead($notificationId)
    {
        $notification = notification::findOrFail($notificationId);
        $notification->read = true;
        $notification->save();

        return response()->json(['success' => true]);
    }
}
