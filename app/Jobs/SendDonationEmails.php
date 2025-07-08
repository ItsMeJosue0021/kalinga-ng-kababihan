<?php

namespace App\Jobs;

use App\Models\Donation;
use App\Mail\CashDonationToAdmin;
use App\Mail\CashDonationReceived;
use App\Mail\GcashDonationToAdmin;
use App\Mail\GcashDonationReceived;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendDonationEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $donation;

    /**
     * Create a new job instance.
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $adminEmail = 'margeiremulta@gmail.com';
        $adminEmail = 'joshuasalceda0021@gmail.com';

        if ($this->donation->type === 'gcash') {
            Mail::to($adminEmail)->send(new GcashDonationToAdmin($this->donation));

            if ($this->donation->email) {
                Mail::to($this->donation->email)->send(new GcashDonationReceived($this->donation));
            }

        } elseif ($this->donation->type === 'cash') {
            Mail::to($adminEmail)->send(new CashDonationToAdmin($this->donation));

            if ($this->donation->email) {
                Mail::to($this->donation->email)->send(new CashDonationReceived($this->donation));
            }
        }
    }
}
