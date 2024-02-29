<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeViewCommand extends Command
{
    protected $signature = 'make:view {view}';
    protected $description = 'Create a new blade template.';

    public function handle()
    {
        $view = $this->argument('view');
        $path = base_path("resources/views/{$view}.blade.php");

        $this->createDir($path);

        if (!File::exists($path))
        {
            $content = 'Hello, this is a new blade template!';
            File::put($path, $content);
            $this->info("File {$path} created.");
        } else {
            $this->error("File {$path} already exists!");
        }
    }

    public function createDir($path)
    {
        $dir = dirname($path);

        if (!File::exists($dir))
        {
            File::makeDirectory($dir, 0777, true);
        }
    }
}
