<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function destroy($id)
    {
        DatabaseNotification::find($id)->delete();

        return back();
    }
}
