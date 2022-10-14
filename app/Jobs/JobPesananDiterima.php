<?php

namespace App\Jobs;

use App\Mail\SendPesananDiterimaAdmin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class JobPesananDiterima implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;
    protected $to;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order, $to)
    {
        $this->order = $order;
        $this->to = $to;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pesanan_baru = new SendPesananDiterimaAdmin($this->order);
        Mail::to($this->to)->send($pesanan_baru);
    }
}
