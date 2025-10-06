<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotificationService {
    public function notify(int $userId, string $message) {

        $user = User::find($userId);
        if(!$user) return false;

        Log::info("Notificación a user {$user->id}: {$message}");

        return true;
    }
}
