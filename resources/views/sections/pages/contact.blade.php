@php
    $section = $page->meta($section['uuid']);
    $form = \TomatoPHP\TomatoForms\Models\Form::find($section['form_id']?? null);
@endphp
<div class="bg-white dark:bg-zinc-900 min-h-screen">
    <div>
        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <section class="px-8 py-8 lg:px-16 font-main">

                <h1 class="my-4 text-4xl font-bold text-center text-main">
                    {{$form ? $form->title : __('How i can help you?')}}
                </h1>
                <p class="text-center">
                    {{$form ? $form->description : __("You can send the details of the service you need or the project you want to do in the form here, or send the details in a message on one of the available communication methods.")}}
                </p>
                <div class="col-span-6 px-8 py-8 border border-zinc-200 dark:border-zinc-700 rounded-lg shadow-sm my-4">
                    @if($form)
                        <x-tomato-form :form="$form"  method="POST" action="{{url('/contact-form')}}" :default="['form_id' => $form->id]"/>
                    @else
                        <x-splade-form class="flex flex-col gap-4" action="{{ url('/contact') }}" method="POST">
                            <x-splade-input type="text" name="name" placeholder="{{__('Your Name')}}" required />
                            <x-splade-input  type="text" name="phone" placeholder="{{__('Phone')}}" required />
                            <x-splade-input  type="email" name="email" placeholder="{{__('Email')}}" required />
                            <x-splade-input  type="text" name="subject" placeholder="{{__('Subject')}}" required />
                            <x-splade-textarea  rows="5" name="message" placeholder="{{__('Message')}}" required />
                            <x-tomato-admin-submit spinner class="col-span-4" label="{{__('Send Message')}}" />
                        </x-splade-form>
                    @endif

                </div>
                <div class="items-center px-8 py-8 my-2 border border-zinc-200 dark:border-zinc-700 rounded-lg shadow-sm col-span-4">
                    <div class="flex flex-col md:flex-row justify-center gap-4">
                        <div class="w-full text-center">
                            <h1 class="pb-4 text-3xl font-bold ">
                                <x-heroicon-o-map-pin class="w-10 h-10 mx-auto my-2 text-sec" />
                                <span class="text-main">{{__('Address')}}</span>
                            </h1>
                            <a href="https://goo.gl/maps/sF7T39oeLgfvYxjW8" target="_blank"
                               class="text-sm text-sec ">{{ setting('site_address') }}</a>
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            <div class="md:ltr:border-r md:rtl:border-l md:h-16 w-16 h-0 md:w-0 border-b border-zinc-200 dark:border-zinc-700">

                            </div>
                        </div>
                        <div class="w-full mb-4 text-center ">
                            <h1 class="pb-4 text-3xl font-bold ">
                                <x-heroicon-o-phone class="w-10 h-10 mx-auto my-2 text-sec" />
                                <span class="text-main">{{__('Phone')}}</span>
                            </h1>
                            <a href="tel:{{ setting('site_phone') }}" class="text-sm text-sec">{{ setting('site_phone') }}</a>
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            <div class="md:ltr:border-r md:rtl:border-l md:h-16 w-16 h-0 md:w-0 border-b border-zinc-200 dark:border-zinc-700">

                            </div>
                        </div>
                        <div class="w-full mb-4 text-center">
                            <h1 class="pb-4 text-3xl font-bold ">
                                <x-heroicon-o-at-symbol class="w-10 h-10 mx-auto my-2 text-sec " />
                                <span class="text-main">{{__('Email')}}</span>
                            </h1>
                            <a href="mailto:{{ setting('site_phone') }}" target="_blank"
                               class="text-sm text-sec">{{ setting('site_email') }}</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>
