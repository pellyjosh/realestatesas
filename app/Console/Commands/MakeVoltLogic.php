<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeVoltLogic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:volt-logic {name : The name of the logic class (e.g. DashboardLogic)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Livewire Volt logic file in app/Livewire/Volt/';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        $studlyName = Str::studly($name);
        $path = app_path("Livewire/Volt/{$studlyName}.php");

        if (File::exists($path)) {
            $this->error("Logic file already exists at: {$path}");
            return;
        }

        File::ensureDirectoryExists(dirname($path));

        File::put($path, <<<PHP
<?php

use function Livewire\\Volt\\{state, mount};

state([
    'message' => 'Hello from {$studlyName}'
]);

mount(function () {
    // Logic runs when component loads
});
PHP);

        $this->info("Volt logic file created: {$path}");
    }
}
