<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cart;
use App\Models\cart_reminder;
use App\Mail\CartReminderMail;
use Illuminate\Support\Facades\Mail;

class SendCartReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cart:send-reminders';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
public function handle()
{
    $carts = Cart::with('user', 'product')->get();

    // Group carts by user_id
    $cartsByUser = $carts->groupBy('user_id');

    foreach ($cartsByUser as $userId => $userCarts) {
        $user = $userCarts->first()->user;

        if (!$user || !$user->email) {
            continue;
        }

        // Products list for this user
        $products = $userCarts->pluck('product')->filter();

        // Reminder count (per user basis, not per product)
        $reminder = cart_reminder::firstOrNew(
            [
                'user_id' => $user->id,
            ]
        );

        if (!$reminder->exists) {
            $reminder->email_count = 0;
            $reminder->sms_count = 0;
        }

        $reminder->email_count += 1;
        $reminder->save();

        // Send email once with all products
        Mail::to($user->email)->send(new CartReminderMail($products));

        $this->info("Email sent to {$user->email}. Total emails sent: " . $reminder->email_count);
    }
}

}
