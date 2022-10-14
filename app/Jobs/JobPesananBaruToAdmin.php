<?php

namespace App\Jobs;

use App\Mail\SendPesananBaruToAdmin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class JobPesananBaruToAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $detail;
    protected $admin;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($detail, $admin)
    {
        $this->detail = $detail;
        $this->admin = $admin;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pesanan_baru = new SendPesananBaruToAdmin($this->detail);
        Mail::to($this->admin)->send($pesanan_baru);
    }
}
