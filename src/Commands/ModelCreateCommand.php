<?php

namespace Windmill\Modules\Commands;

use Windmill\Modules\Traits\BuildVars;
use Illuminate\Console\Command;

class ModelCreateCommand extends Command
{
    use BuildVars;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'windmill:model {model} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create model and migration';

    protected $module;
    protected $model;

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
        $this->model  = ucfirst($this->argument('model'));
        $this->module = ucfirst($this->argument('module'));
        $this->setVars($this->model,$this->module);
        $this->createModel();
    }

    protected function createModel()
    {
        $content = $this->replaceVars(__DIR__.'/models/model.tpl');
        $file    = $this->getVar('MODEL_PATH').$this->model.'.php';
        file_put_contents($file, $content);
        $this->info('model create successflly');
    }

}
