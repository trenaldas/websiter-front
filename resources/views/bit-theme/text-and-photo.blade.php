<section class="text-gray-700 body-font">
    <div class="container flex flex-col items-center px-5 py-6 mx-auto lg:px-8 md:flex-row">
        <div class="flex flex-col items-center w-full pt-0 mb-16 text-left lg:flex-grow md:w-1/2 xl:mr-20 md:pr-24 md:items-start md:text-left md:mb-0 lg:text-center">
            <h1 class="mb-8 text-2xl font-bold tracking-tighter text-center text-black lg:text-left lg:text-5xl title-font">
                {{ $bit->name }}
            </h1>
            <p class="mb-8 text-base leading-relaxed text-center text-gray-700 lg:text-left lg:text-1xl">
                {{ $bit->text }}
            </p>
            <div class="grid grid-cols-3 gap-4">
                @if($bit->price)
                    <span class="font-medium text-2xl text-gray-900">@money($bit->price, $project->currency->name)</span>
                    <button wire:click="addToCart({{$bit->id}})" class="flex ml-auto text-white bg-purple-500 border-0 py-2 px-6 focus:outline-none hover:bg-purple-600 rounded-full">{{ __('To Cart') }}</button>
                @endif
                @if(count($bit->childrenBits) > 0)
                    <a href="{{ route('bit.show', $bit->id) }}" class="ml-auto text-white bg-purple-500 border-0 py-2 px-6 focus:outline-none hover:bg-purple-600 rounded-full">{{ __('More') }}</a>
                @endif
            </div>
        </div>
        <div class="w-5/6 lg:max-w-lg lg:w-full md:w-1/2">
            <img class="object-cover object-center rounded-lg " alt="hero" src="{{ $bit->getFirstMedia()->getFullUrl() }}">
        </div>
    </div>
</section>
