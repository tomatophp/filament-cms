<nav aria-label="Breadcrumb">
    <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 lg:max-w-7xl">
        <li>
            <div class="flex items-center">
                <x-splade-link href="/" class="mr-2 text-sm font-medium text-gray-900">{{__('Home')}}</x-splade-link>
                <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
                    <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                </svg>
            </div>
        </li>
        @foreach($links as $key=>$link)
            <li>
                <div class="flex items-center">
                    @if($key === count($links) - 1)
                        <x-splade-link href="{{$link['url']}}" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">{{$link['label']}}</x-splade-link>
                    @else
                        <x-splade-link href="{{$link['url']}}" class="mr-2 text-sm font-medium text-gray-900">{{$link['label']}}</x-splade-link>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                        </svg>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>
