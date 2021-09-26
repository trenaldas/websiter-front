<section class="overflow-hidden text-gray-700 body-font">
    <div class="container flex flex-col items-center px-5 py-8 mx-auto md:flex-row">
        <div class="flex flex-wrap justify-center mx-auto ">
            @foreach($bit->getMedia() as $media)
                <div class="w-full mt-6 lg:w-2/4 lg:pl-5 lg:pr-5 lg:py-6 lg:mt-0">
                    <img src="{{ $media->getFullUrl() }}" alt="{{ $bit->name }}-media"  class="object-cover object-center w-full h-64 rounded-lg lg:h-auto">
                </div>
            @endforeach
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
