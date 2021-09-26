<section class="overflow-hidden text-gray-700 body-font">
    <div class="container flex flex-col items-center px-5 py-16 mx-auto md:flex-row">
        <div class="flex flex-wrap -m-1 md:-m-2 md:p-2">
            <div class="flex flex-wrap w-1/2">
                <div class="w-1/2 p-1 md:p-2">
                    <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                         src="{{ $bit->getMedia()[0]->getFullUrl() }}">
                </div>
                <div class="w-1/2 p-1 md:p-2">
                    <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                         src="{{ $bit->getMedia()[1]->getFullUrl() }}">
                </div>
                <div class="w-full p-1 md:p-2">
                    <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                         src="{{ $bit->getMedia()[2]->getFullUrl() }}">
                </div>
            </div>
            <div class="flex flex-wrap w-1/2">
                <div class="w-full p-1 md:p-2">
                    <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                         src="{{ $bit->getMedia()[3]->getFullUrl() }}">
                </div>
                <div class="w-1/2 p-1 md:p-2">
                    <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                         src="{{ $bit->getMedia()[4]->getFullUrl() }}">
                </div>
                <div class="w-1/2 p-1 md:p-2">
                    <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                         src="{{ $bit->getMedia()[5]->getFullUrl() }}">
                </div>
            </div>
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

