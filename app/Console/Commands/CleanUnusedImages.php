<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class CleanUnusedImages extends Command
{
    protected $signature = 'images:clean';
    protected $description = 'This command removes unused images from multiple folders under public/uploads.';

    /**
     * Register the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(\Illuminate\Console\Scheduling\Schedule $schedule)
    {
        $schedule->command(static::class)->everyThirtyMinutes();
    }

    public function handle()
    {
        $imageDirectories = [
            public_path('uploads/Logo'),
            public_path('uploads/about'),
            public_path('uploads/contact'),
            public_path('uploads/settings'),
            public_path('uploads/users'),
            public_path('uploads/enquiry'),
            public_path('uploads/Sliders'),
            public_path('uploads/Testimonials'),
            public_path('uploads/Product_Categories'),
            public_path('uploads/products'),
            public_path('uploads/Service_Categories'),
            public_path('uploads/services'),
            public_path('uploads/Blog_Categories'),
            public_path('uploads/Blogs'),
        ];

        $tablesAndColumns = [
            ['table' => 'about', 'column' => 'image'],
            ['table' => 'contact', 'column' => 'image'],
            ['table' => 'settings', 'column' => 'Value'],
            ['table' => 'users', 'column' => 'image'],
            ['table' => 'enquiry', 'column' => 'image'],
            ['table' => 'sliders', 'column' => 'File_Name'],
            ['table' => 'testimonials', 'column' => 'File_Name'],
            ['table' => 'product_categories', 'column' => 'File_Name'],
            ['table' => 'products', 'column' => 'File_Name'],
            ['table' => 'product_files', 'column' => 'File_Name'],
            ['table' => 'service_categories', 'column' => 'File_Name'],
            ['table' => 'services', 'column' => 'File_Name'],
            ['table' => 'blog_categories', 'column' => 'File_Name'],
            ['table' => 'blogs', 'column' => 'File_Name'],
        ];

        $usedImages = [];

        foreach ($tablesAndColumns as $entry) {
            $table = $entry['table'];
            $column = $entry['column'];
            if (Schema::hasTable($table) && Schema::hasColumn($table, $column)) {
                $usedImages = array_merge($usedImages, DB::table($table)->pluck($column)->filter()->toArray());
            }
        }

        $usedImages = array_unique($usedImages);

        $deletedCount = 0;

        foreach ($imageDirectories as $imageDirectory) {
            $this->info("Checking image directory: $imageDirectory");

            if (!File::exists($imageDirectory)) {
                try {
                    File::makeDirectory($imageDirectory, 0755, true);
                    $this->info("Directory not found. Created directory: $imageDirectory");
                } catch (\Exception $e) {
                    $this->error("Failed to create directory: $imageDirectory. Error: " . $e->getMessage());
                    continue;
                }
            }

            $allFiles = File::files($imageDirectory);

            if (empty($allFiles)) {
                $this->info("No files found in the image directory: $imageDirectory");
                continue;
            }

            // Chank the files for processing in batches of 100
            $chunks = array_chunk($allFiles, 100);

            foreach ($chunks as $chunk) {
                foreach ($chunk as $file) {
                    $fileName = $file->getFilename();

                    if (!in_array($fileName, $usedImages)) {
                        File::delete($file->getRealPath());
                        $this->info("Deleted: $fileName");
                        $deletedCount++;
                    }
                }
            }
        }

        if ($deletedCount === 0) {
            $this->info('No unused images found.');
        } else {
            $this->info("Total {$deletedCount} unused images deleted.");
        }
    }
}
