<?php

namespace TomatoPHP\FilamentCms\Services\Contracts;

use Illuminate\Support\Facades\Cookie;

class FormInput
{
    public ?string $label = null;
    public ?string $placeholder = null;
    public ?string $hint = null;
    public ?string $name = null;
    public ?string $group = null;
    public ?string $default = null;
    public ?string $input_type = null;
    public ?int $order = 0;
    public ?string $required_message = null;
    public ?string $reactive_field = null;
    public ?string $reactive_where = null;
    public ?string $table_name = null;
    public ?array $options = null;
    public ?bool $has_valdation = false;
    public ?bool $is_requred= false;
    public ?bool $is_reavtive= false;
    public ?bool $is_from_table= false;
    public ?bool $is_multi= false;
    public ?bool $has_options= false;
    public ?int $max=255;
    public ?int $min=1;
    public ?string $type="string";
    public ?string $option_root="data";
    public ?string $option_value="id";
    public ?string $option_label="name";

    public function __construct()
    {
        // decrypt
        try {
            $decryptedString = \Crypt::decrypt(Cookie::get('lang'), false);
            $lang = json_decode(explode('|', $decryptedString)[1]);
            app()->setLocale($lang->id ?? config('app.locale'));
        }catch (\Exception $exception) {}
    }

    public function toArray(){
        return [
            'label' => $this->label,
            'placeholder' => $this->placeholder,
            'hint' => $this->hint,
            'type' => $this->type,
            'name' => $this->name,
            'group' => $this->group,
            'default' => $this->default,
            'order' => $this->order,
            'required_message' => $this->required_message,
            'reactive_field' => $this->reactive_field,
            'reactive_where' => $this->reactive_where,
            'table_name' => $this->table_name,
            'options' => $this->options,
            'has_valdation' => $this->has_valdation,
            'is_requred' => $this->is_requred,
            'is_reavtive' => $this->is_reavtive,
            'is_from_table' => $this->is_from_table,
            'is_multi' => $this->is_multi,
            'has_options' => $this->has_options,
            'validation' => [
                'max' => $this->max,
                'min' => $this->min,
                'type' => $this->input_type,
                'option_root' => $this->option_root,
                'option_value' => $this->option_value,
                'option_label' => $this->option_label,
            ]
        ];
    }


    /**
     * @return static
     */
    public static function make(): static
    {
        return (new static);
    }

    public function label(string $label): static
    {
        $this->label = $label;
        return $this;
    }

    public function input_type(string $input_type): static
    {
        $this->input_type = $input_type;
        return $this;
    }

    public function placeholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function hint(string $hint): static
    {
        $this->hint = $hint;
        return $this;
    }

    public function name(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function group(string $group): static
    {
        $this->group = $group;
        return $this;
    }

    public function default(string $default): static
    {
        $this->default = $default;
        return $this;
    }

    public function order(int $order): static
    {
        $this->order = $order;
        return $this;
    }

    public function required_message(string $required_message): static
    {
        $this->required_message = $required_message;
        return $this;
    }

    public function reactive_field(string $reactive_field): static
    {
        $this->reactive_field = $reactive_field;
        return $this;
    }

    public function reactive_where(string $reactive_where): static
    {
        $this->reactive_where = $reactive_where;
        return $this;
    }

    public function table_name(string $table_name): static
    {
        $this->table_name = $table_name;
        return $this;
    }

    public function options(array $options): static
    {
        $this->options = $options;
        return $this;
    }

    public function has_valdation(bool $has_valdation): static
    {
        $this->has_valdation = $has_valdation;
        return $this;
    }

    public function is_requred(bool $is_requred): static
    {
        $this->is_requred = $is_requred;
        return $this;
    }

    public function is_reavtive(bool $is_reavtive): static
    {
        $this->is_reavtive = $is_reavtive;
        return $this;
    }

    public function is_from_table(bool $is_from_table): static
    {
        $this->is_from_table = $is_from_table;
        return $this;
    }

    public function is_multi(bool $is_multi): static
    {
        $this->is_multi = $is_multi;
        return $this;
    }

    public function has_options(bool $has_options): static
    {
        $this->has_options = $has_options;
        return $this;
    }

    public function max(int $max): static
    {
        $this->max = $max;
        return $this;
    }

    public function min(int $min): static
    {
        $this->min = $min;
        return $this;
    }

    public function type(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function option_label(string $option_label): static
    {
        $this->option_label = $option_label;
        return $this;
    }

    public function option_value(string $option_value): static
    {
        $this->option_value = $option_value;
        return $this;
    }

    public function option_root(string $option_root): static
    {
        $this->option_root = $option_root;
        return $this;
    }



}
