<?php

namespace App\Jobs;

use App\Models\TransactionBackup;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        TransactionBackup::create([
            "name" => $this->data->name,
            "phone_number" => $this->data->phone_number,
            "amount" => $this->data->amount,
            "reff" => $this->data->reff,
            "code" => $this->data->code,
            "expired_at" => $this->data->expired_at
        ]);
    }
}
