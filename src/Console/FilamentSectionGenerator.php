<?php

namespace TomatoPHP\FilamentCms\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;
use TomatoPHP\FilamentCms\Models\Type;
use TomatoPHP\FilamentCms\Services\GenerateSection;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\search;
use function Laravel\Prompts\suggest;
use function Laravel\Prompts\text;

class FilamentSectionGenerator extends Command
{
    use RunCommand;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filament-section:generate
        {section=0}
        {module=0}
        {view=0}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate a new section class inside your module or app';



    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sectionName = ($this->argument('section') && $this->argument('section') != "0") ? $this->argument('section') : text(
            label: 'Please input your section name?',
            placeholder: "ex: tomato hero section",
        );

        //Check if user need to use HMVC
        $isModule = ($this->argument('module') && $this->argument('module') != "0") ?: confirm('Do you went to use HMVC module?');
        $moduleName = false;
        if ($isModule){
            if (class_exists(\Nwidart\Modules\Facades\Module::class)){
                $modules = \Nwidart\Modules\Facades\Module::toCollection()->map(function ($item){
                    return $item->getName();
                });
                $moduleName = ($this->argument('module') && $this->argument('module') != "0") ? $this->argument('module') : suggest(
                    label:'Please input your module name?',
                    placeholder:'Translations',
                    options: fn (string $value) => strlen($value) > 0
                        ? collect($modules)->filter(function ($item, $key) use ($value){
                            return Str::contains($item, $value) ? $item : null;
                        })->toArray()
                        : [],
                    validate: fn (string $value) => match (true) {
                        strlen($value) < 1 => "Sorry this filed is required!",
                        default => null
                    },
                    scroll: 10
                );
                $check = \Nwidart\Modules\Facades\Module::find($moduleName);
                if (!$check) {
                    $createIt = confirm('Module not found! do you when to create it?');
                    $createIt ? $this->artisanCommand(["module:make", $moduleName]) : $moduleName = null;
                }
            }
            else {
                $installItem = confirm('Sorry nwidart/laravel-modules not installed please install it first. do you when to install it?');
                if($installItem){
                    $this->requireComposerPackages(["nwidart/laravel-modules"]);
                    \Laravel\Prompts\info('Add This line to composer.json psr-4 autoload');
                    \Laravel\Prompts\info('"Modules\\" : "Modules/"');
                    \Laravel\Prompts\info('now run');
                    \Laravel\Prompts\info('composer dump-autoload');
                    \Laravel\Prompts\info('Install success please run the command again');
                    exit();
                }
            }
        }

        $view = ($this->argument('view') && $this->argument('view') != "0") ? $this->argument('view') : text(
            label: 'Please input your view path?',
            placeholder: "ex: sections.hero",
        );

        $generator = new GenerateSection(
            section: $sectionName,
            moduleName: $moduleName,
            view: $view
        );
        $generator->generate();


        \Laravel\Prompts\info('Tomato Section generated successfully.');
    }
}
