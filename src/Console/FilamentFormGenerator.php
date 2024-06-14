<?php

namespace TomatoPHP\FilamentCms\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use TomatoPHP\ConsoleHelpers\Traits\HandleStub;
use TomatoPHP\FilamentCms\Models\Field;
use TomatoPHP\FilamentCms\Models\Form;

class FilamentFormGenerator extends Command
{
    use HandleStub;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'filament-form:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use to generate a full from migration to build a form seeder';

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
        $buildFieldsArray = collect([]);
        $title = $this->ask('please input your form title');
        $key = $this->ask('please input your form key', Str::slug($name));
        $checkIfFormExists = Form::where('key', $key??Str::slug($name))->first();
        $key= $key??Str::slug($name);
        while ($checkIfFormExists){
            $this->error('Form already exists');
            $key = $this->ask('please input your form key [unique]', Str::slug($name));
            $checkIfFormExists = Form::where('key', $key??Str::slug($name))->first();
            $key= $key??Str::slug($name);
        }
        $endpoint = $this->ask('please input your form endpoint', '/');
        $method = $this->ask('please input your form method', 'POST');
        $description = $this->ask('please input your form description');
        $type = $this->ask('please input your form type', 'page');

        $fields = [];
        $add = true;
        while ($add){
            $fieldKey = $this->ask('please input your first field key');
            $checkIfFieldExists = Field::where('key', $fieldKey)->first();
            if(!$checkIfFieldExists){
                $ask = $this->ask('Field not exits exists do you went to create new? [yes/no]', 'no');
                if($ask === 'yes' || $ask === 'y'){
                    $type = $this->ask('type', 'text');
                    $label = $this->ask('label');
                    $fieldKey = $this->ask('key [unique]', Str::slug($label));
                    $placeholder = $this->ask('placeholder');
                    $required = $this->ask('Is Required? [yes/no]', 'yes');
                    $hasOptions = $this->ask('Has Options? [yes/no]', 'no');

                    $buildFieldsArray->push("           [");
                    $buildFieldsArray->push("              'label'=>'".$label. "',");
                    $buildFieldsArray->push("              'key'=>'".$fieldKey ?? Str::slug($fieldKey). "',");
                    $buildFieldsArray->push("              'type'=>'".$type. "',");
                    $buildFieldsArray->push("              'placeholder'=>'".$placeholder. "',");
                    if($required || $required === 'n' || $required === 'no'){
                        $buildFieldsArray->push("               'is_required'=>false,");
                    }
                    else {
                        $buildFieldsArray->push("               'is_required'=>true,");
                    }
                    if($hasOptions || $hasOptions === 'y' || $hasOptions === 'yes'){
                        $buildFieldsArray->push("              'has_options'=>true,");
                    }
                    else {
                        $buildFieldsArray->push("              'has_options'=>false,");
                    }


                    if($hasOptions === 'y' || $hasOptions === 'yes'){
                        $options = $this->ask('options LIKE: male, female');
                        $buildFieldsArray->push("               'options'=>".$options. ",");

                        $options = explode(',', $options);
                        $options = array_map(function ($option){
                            return trim($option);
                        }, $options);
                    }

                    $buildFieldsArray->push("           ],");

                    $createNewField = new Field();
                    $createNewField->label = $label;
                    $createNewField->key = $fieldKey ?? Str::slug($fieldKey);
                    $createNewField->type = $type;
                    $createNewField->placeholder = $placeholder;
                    $createNewField->is_required = ($required || $required === 'n' || $required === 'no') ? false : true;
                    $createNewField->has_options = ($hasOptions === 'y' || $hasOptions === 'yes') ? true : false;

                    $createNewField->save();

                    if($hasOptions === 'y' || $hasOptions === 'yes'){
                        foreach ($options as $option){
                            $createNewField->options()->create([
                                'type' => 'text',
                                'label' => $option,
                                'value' => $option,
                            ]);
                        }
                    }

                    $fields[] = $createNewField->id;
                }

            }
            else {
                $buildFieldsArray->push("           [");
                $buildFieldsArray->push("               'label'=>'".$checkIfFieldExists->label. "',");
                $buildFieldsArray->push("               'key'=>'".$checkIfFieldExists->key. "',");
                $buildFieldsArray->push("               'type'=>'".$checkIfFieldExists->type. "',");
                $buildFieldsArray->push("               'placeholder'=>'".$checkIfFieldExists->placeholder. "',");
                if($checkIfFieldExists->is_required){
                    $buildFieldsArray->push("               'is_required'=>true,");
                }
                else {
                    $buildFieldsArray->push("               'is_required'=>false,");
                }
                if($checkIfFieldExists->has_options){
                    $buildFieldsArray->push("               'has_options'=>true,");
                }
                else {
                    $buildFieldsArray->push("               'has_options'=>false,");
                }
                if($checkIfFieldExists->has_options){
                    $getOptions = "";
                    foreach($checkIfFieldExists->options as $optionKey=>$option){
                        $getOptions .= $option->value;
                        if($optionKey !== count($option)-1){
                            $getOptions.= ",";
                        }
                    }
                    $buildFieldsArray->push("               'options'=>".$getOptions. ",");
                }
                $buildFieldsArray->push("           ],");

                $fields[] = $checkIfFieldExists->id;
            }

            $addMore = $this->ask('Do you want to add more fields? [yes/no]', 'no');
            $add = $addMore === 'yes' || $addMore === 'y' ? true : false;
        }

        $createNewForm = new Form();
        $createNewForm->name = $title;
        $createNewForm->key = $key;
        $createNewForm->endpoint = $endpoint ?? '/';
        $createNewForm->method = $method ?? 'POST';
        $createNewForm->description = $description ?? null;
        $createNewForm->type = $type;
        $createNewForm->save();

        $createNewForm->fields()->attach($fields);

        $this->generateStubs(
            __DIR__ . '/../../stubs/migration.stub',
            database_path('migrations/'.date('Y_m_d_His').'_fill_form_for_'.Str::lower($key).'.php'),
            [
                'name' => Str::ucfirst(Str::camel($key)),
                'key' => $key,
                'fields' => $buildFieldsArray->implode("\n"),
                'formName' =>  $title,
                'formEndpoint' =>  $endpoint ?? '/',
                'formMethod' => $method ?? 'POST',
                'formDescription' => $description ?? '',
                'formType' => $type,
            ]
        );

        $this->info('Form created successfully');
    }
}
