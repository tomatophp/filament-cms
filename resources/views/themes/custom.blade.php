<x-tomato-admin-layout>
    <x-slot name="header">
        Theme Customizer
    </x-slot>
    <x-slot name="headerBody">
        <x-splade-link href="{{route('admin.themes.index')}}" class="disabled:bg-gray-600 disabled:hover:bg-gray-500 filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2rem] px-3 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700">
            Back
        </x-splade-link>
    </x-slot>


    <div class="my-4">
        <x-splade-form :default="$default" method="POST" action="{{route('admin.themes.custom.save', $theme['name'])}}">
            <div class="flex flex-col space-y-4">
                <div>
                    <x-tomato-color name="theme_main_color" label="Theme Main Color" />
                    <div class="p-1">
                        <small class="text-red-500"><code>theme_setting('main_color')</code></small>
                    </div>
                </div>
                <div>
                    <x-tomato-color name="theme_secandry_color" label="Theme Secondary Color" />
                    <div class="p-1">
                        <small class="text-red-500"><code>theme_setting('secandry_color')</code></small>
                    </div>
                </div>
                <div>
                    <x-tomato-color name="theme_sub_color" label="Theme Sub Color" />
                    <div class="p-1">
                        <small class="text-red-500"><code>theme_setting('sub_color')</code></small>
                    </div>
                </div>
                <div>
                    <x-tomato-code name="theme_header" label="Theme Header" />
                    <div class="p-1">
                        <small class="text-red-500"><code>theme_setting('header')</code></small>
                    </div>
                </div>
                <div>
                    <x-tomato-code name="theme_footer" label="Theme Footer" />
                    <div class="p-1">
                        <small class="text-red-500"><code>theme_setting('footer')</code></small>
                    </div>
                </div>
                <div>
                    <x-tomato-code name="theme_css" label="Theme CSS" />
                    <div class="p-1">
                        <small class="text-red-500"><code>theme_setting('css')</code></small>
                    </div>
                </div>
                <div>
                    <x-tomato-code name="theme_js" label="Theme JS" />
                    <div class="p-1">
                        <small class="text-red-500"><code>theme_setting('js')</code></small>
                    </div>
                </div>
                <div>
                    <x-splade-input name="theme_copyright" label="Theme Copyright"/>
                    <div class="p-1">
                        <small class="text-red-500"><code>theme_setting('copyright')</code></small>
                    </div>
                </div>
                @if(count((array)$theme['info']->settings))
                <hr>
                <div>
                    <h1 class="font-bold">Special Theme Setting Variables</h1>
                </div>
                <hr>
                @endif
                @foreach($theme['info']->settings as $key=>$setting)
                    @if($setting->type == 'color')
                        <div>
                            <x-tomato-color :name="$key" :label="$setting->label" :placeholder="$setting->label" :required="$setting->required"/>
                            <div class="p-1">
                                <small class="text-red-500"><code>theme_setting('{{$key}}')</code></small>
                            </div>
                        </div>
                    @else
                        <div>
                            <x-splade-input :name="$key" :type="$setting->type" :label="$setting->label" :placeholder="$setting->label" :required="$setting->required"/>
                            <div class="p-1">
                                <small class="text-red-500"><code>theme_setting('{{$key}}')</code></small>
                            </div>
                        </div>
                    @endif
                @endforeach
                <x-splade-submit>Save</x-splade-submit>
            </div>
        </x-splade-form>
    </div>
</x-tomato-admin-layout>
