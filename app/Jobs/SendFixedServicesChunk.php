<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\FixedServicesNotification;

class SendFixedServicesChunk implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $users;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users, $data)
    {
        $this->users = $users;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $delayMinutes = 0;
        foreach ($this->users as $user) {
            Mail::to($user['email'])->later(now()->addMinutes($delayMinutes), (new FixedServicesNotification($user, $this->data))->onQueue('send_fixed_service_mail'));
            $delayMinutes += 1;
        }
    }
    
    public function failed(\Exception $exception)
    {
        \Log::error('Job failed for users: ' . json_encode($this->users));
    }
}
