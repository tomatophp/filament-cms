<?php

namespace TomatoPHP\FilamentCms\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;
use TomatoPHP\FilamentCms\Generator\GenerateTheme;
use TomatoPHP\FilamentTranslations\Services\SaveScan;
use function Laravel\Prompts\error;
use function Laravel\Prompts\spin;
use function Laravel\Prompts\text;

class FilamentThemeGenerator extends Command
{
    use RunCommand;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'filament-cms:theme';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate a new theme for tomato-themes plugin';

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
        $themeName =text(label:'What is the name of the theme?', required: true);
        if(!$themeName){
            error('Theme name is required');
            $themeName = text(label:'What is the name of the theme?', required: true);
        }

        $themeDescription = text(label:'What is the description of the theme?', required: true, default: 'No description');


        $response = spin(
            function () use ($themeName, $themeDescription) {
                $generate = new GenerateTheme(
                    themeName: $themeName,
                    themeDescription: $themeDescription
                );
                $generate->generate();

            },
            'Generate Theme ...'
        );

        \Laravel\Prompts\info('Theme generated successfully');

        shell_exec('composer dump-autoload');

    }
}
