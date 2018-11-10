<?php
namespace Windmill\Modules\Commands;

use Illuminate\Console\Command;

class ModuleCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'windmill:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a module';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = ucfirst($this->argument('name'));
        if (\Module::has($name)) {
            return $this->error("Module [{$this->name}] already exists");
        }
        $this->call('module:make', [
            'name' => [$name],
        ]);
        $this->call('windmill:config', [
            'name' => $name,
        ]);

        $this->info("module creating successful");
    }
}
