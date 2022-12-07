<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Image;

class ImageResizeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:resize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file_display = [ 'jpg', 'jpeg', 'png', 'gif' ];

        // get all files
        $allFiles = Storage::allFiles();

        foreach ($allFiles as $key => $item) {
            try {

                if ($key > 10) break;

                $file_type = pathinfo($item, PATHINFO_EXTENSION);
                // valid formats
                if (in_array($file_type, $file_display)) {
                    //get single file
                    $image = Storage::get($item);

                    $imgFile = Image::make($image);
                    // resize image and save
                    $imgFile->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(storage_path('app/'.$item));

                    // move resized image to another folder
                    Storage::move($item,'resized/'.basename($item));

                    echo $item." : has been resized successfully ".PHP_EOL;
                }
            } catch (\Exception $e) {
                echo "error ".$item." : ".$e->getMessage().PHP_EOL;
            }
        }
    }
}
