<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class kirimWhatsapp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $pesan;
    private $nomor;

    public function __construct($pesan, $nomor)
    {
        $this->pesan = $pesan;
        $this->nomor = $nomor;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Http::withHeaders([
            'Authorization' => config('app.token_wa'),
        ])->withoutVerifying()->post(config('app.wa_url') . "/send-message", [
                    'phone' => $this->nomor,
                    'message' => $this->pesan,
                ]);
    }
}
