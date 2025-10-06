<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotificationService {
    public function notify(int $userId, string $message) {
        // Implementación simple: registro en log o mailing
        $user = User::find($userId);
        if(!$user) return false;

        // Puedes usar Queue/Jobs y Mailables para producción
        Log::info("Notificación a user {$user->id}: {$message}");

        // Si tienes un mailable:
        // Mail::to($user->email)->queue(new AppointmentCreated($message));

        return true;
    }
}
