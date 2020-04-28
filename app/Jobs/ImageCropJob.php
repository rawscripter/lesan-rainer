<?php

namespace App\Jobs;

use App\Http\Controllers\ImageController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImageCropJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $imageUrl;
    protected $name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $imageUrl)
    {
        $this->name = $name;
        $this->imageUrl = $imageUrl;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ImageController::cropImageFromDropbox($this->name, $this->imageUrl);
    }
}
