@php
    SEO::openGraphType('WebPage');
    SEO::openGraphSiteName($page->title ?? setting('site_name'));
    SEO::openGraphTitle($page->title ?? setting('site_name'));
    SEO::openGraphUrl(url()->current());
    SEO::openGraphImage($page->getMedia('cover')->first()?->getUrl() ?? setting('site_profile'));
    SEO::metaByProperty('og:description', $page->short_description ?? setting('site_description'));

    SEO::twitterCard('summary_large_image');
    SEO::twitterTitle($page->title ?? setting('site_name'));
    SEO::twitterDescription($page->short_description ?? setting('site_description'));
    SEO::twitterImage($page->getMedia('cover')->first()?->getUrl() ?? setting('site_profile'));

    SEO::canonical(url()->current());
@endphp
@seoTitle($page->title ?? setting('site_name'))
@seoDescription($page->short_description ?? setting('site_description'))
@seoKeywords($page->keywords ?? setting('site_keywords'))

@if(auth('web')->user())
    @php
        $sections = \TomatoPHP\TomatoThemes\Facades\TomatoThemes::getSections();
    @endphp
    <div class="border-b border-zinc-700  bg-zinc-800 p-4 w-full sticky top-0 z-10">
        <div class="flex justify-between gap-4">
            <div>
                <x-splade-form confirm method="POST" action="{{route('admin.pages.sections', $page->id)}}" :default="[
                        'section' => $sections[0]['key']
                    ]">
                    <div class="flex justify-start gap-4 w-full">
                        <x-splade-select
                            name="section"
                            choices="{allowHTML: true}"
                            class="w-80"
                            placeholder="{{__('Select Section')}}"
                        >
                            @foreach($sections as $section)
                                <option value="{{ $section['key'] }}">
                                    <div class="flex justify-start gap-2">
                                        <div class="flex flex-col items-center justify-center">
                                            <i class="{{ $section['icon'] }}"></i>
                                        </div>
                                        <div>
                                            {{ $section['label'] }}
                                        </div>
                                    </div>
                                </option>
                            @endforeach
                        </x-splade-select>
                        <div class="h-full">
                            <button type="submit" class="px-6 h-11 bg-primary-500 text-white rounded-lg">
                                {{__('Add')}}
                            </button>
                        </div>
                    </div>
                </x-splade-form>
            </div>
            <div class="justify-end hidden lg:flex">
                <div>
                    <x-splade-link
                        href="{{route('admin.themes.page.edit', $page->id)}}"
                        modal="{maxWidth: '7xl'}"
                        type="button"
                        class="filament-icon-button flex items-center justify-center rounded-full relative hover:bg-zinc-500/5 focus:outline-none text-danger-500 focus:bg-danger-500/10 dark:hover:bg-zinc-300/5 w-10 h-10 ml-4 -mr-1">
                        <x-heroicon-s-pencil-square class="w-6 h-6" />
                    </x-splade-link>
                </div>
                @if(class_exists(\TomatoPHP\TomatoNotifications\Models\UserNotification::class))
                    <!-- Notifications -->
                    <div>
                        <div class="filament-notifications pointer-events-none fixed inset-4 z-50 mx-auto flex justify-end gap-3 items-end flex-col-reverse" role="status">
                        </div>

                        <!-- Notifications -->
                        <div>
                            <!-- Open Notification Modal -->
                            <Link modal href="/admin/notifications" class="inline-block">
                            <button
                                title="filament::layout.database_notifications"
                                type="button"
                                class="filament-icon-button flex items-center justify-center rounded-full relative hover:bg-zinc-500/5 focus:outline-none text-primary-500 focus:bg-primary-500/10 dark:hover:bg-zinc-300/5 w-10 h-10 ml-4 -mr-1">
                            <span class="sr-only">

                            </span>

                                <svg class="filament-icon-button-icon w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                <span class="filament-icon-button-indicator absolute rounded-full text-xs inline-block w-4 h-4 -top-0.5 -right-0.5 bg-primary-500/10">
                                {{
                                    \TomatoPHP\TomatoNotifications\Models\UserNotification::where('model_type',User::class)
                                            ->where('model_id', auth()->user()->id)
                                            ->orWhere('model_id', null)
                                            ->get()->count()
                                }}
                            </span>
                            </button>
                            </Link>
                        </div>

                        <div></div>
                    </div>
                @endif

                <x-tomato-admin-profile-dropdown />
            </div>
        </div>
    </div>
@endif
@if(count($page->meta('sections') ?? []))
    @foreach(collect($page->meta('sections'))->sortBy('order') as $section)
        @if(auth('web')->user())
            <x-splade-data :default="['showOptions' => false]">
                <div @mouseover="data.showOptions = true" @mouseleave="data.showOptions = false" class="relative">
                    @if(view()->exists($section['section']))
                        @include($section['section'], ['page' => $page, 'section' => $section, 'sectionID' =>$section['uuid']])
                        <div class="my-4 mx-4 absolute z-0 bottom-0 left-0" v-if="data.showOptions">
                            @if($section['form'])
                                <x-tomato-admin-button  href="{{route('admin.pages.meta', $page->id) . '?section='. $section['uuid']}}" modal>
                                    <i class="bx bx-edit"></i>
                                </x-tomato-admin-button>
                            @endif
                            <x-tomato-admin-button danger confirm method="DELETE" :data="['section' => $section['uuid']]" href="{{route('admin.pages.remove', $page->id)}}">
                                <i class="bx bx-trash"></i>
                            </x-tomato-admin-button>
                        </div>
                    @else
                        <div class="cursor-move flex flex-col gap-4 m-4 text-danger-500 items-center text-center justifiy-center w-full border rounded-lg p-4">
                            <x-heroicon-s-x-circle class="w-12 h-12" />
                            {{__('View Not Exists Please Delete IT!')}}
                        </div>
                        <div class="my-4 mx-4 absolute z-0 bottom-0 left-0" v-if="data.showOptions">
                            <x-tomato-admin-button danger confirm method="DELETE" :data="['section' => $section['uuid']]" href="{{route('admin.pages.remove', $page->id)}}">
                                <i class="bx bx-trash"></i>
                            </x-tomato-admin-button>
                        </div>
                    @endif
                </div>
            </x-splade-data>
        @else
            @if(view()->exists($section['section']))
                @include($section['section'], ['page' => $page, 'section' => $section, 'sectionID' =>$section['uuid']])
            @else
                <div class="cursor-move flex flex-col gap-4 m-4 text-danger-500 items-center text-center justifiy-center w-full border rounded-lg p-4">
                    <x-heroicon-s-x-circle class="w-12 h-12" />
                    {{__('View Not Exists Please Delete IT!')}}
                </div>
            @endif
        @endif
    @endforeach
@else
    <div>
        {!! $page->body !!}
    </div>
@endif
