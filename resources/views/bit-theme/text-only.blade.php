<section class="text-gray-600 body-font">
    <div class="container px-5 py-12 mx-auto">
        <div class="flex flex-col text-center w-full mb-12">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">{{ $bit->name }}</h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">{{ $bit->text }}</p>
        </div>
    </div>
    <div class="container flex items-center px-5 mx-auto md:flex-row">
        <div class="flex">
            @if($bit->price)
                <span class="font-medium text-2xl text-gray-900">@money($bit->price, $project->currency->name)</span>
                <button wire:click="addToCart({{$bit->id}})" class="flex ml-12 text-white bg-purple-500 border-0 py-2 px-6 focus:outline-none hover:bg-purple-600 rounded-full">{{ __('To Cart') }}</button>
            @endif
        </div>
        @if(count($bit->childrenBits) > 0)
            <a href="{{ route('bit.show', $bit->id) }}" class="ml-auto text-white bg-purple-500 border-0 py-2 px-6 focus:outline-none hover:bg-purple-600 rounded-full">{{ __('More') }}</a>
        @endif
    </div>
</section>
