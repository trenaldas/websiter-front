<section class="overflow-hidden text-gray-700 body-font">
    <div class="container px-5 py-2 mx-auto lg:px-10">
        <div class="flex flex-wrap py-8 md:flex-no-wrap">
            <div class="w-full">
                <img src="{{ $bit->getFirstMedia()->getFullUrl() }}" alt="image" style="height:400px;" class="object-cover object-center w-full h-64 rounded-lg lg:h-auto">
                <div class="flex flex-col items-start mx-auto mt-8 sm:flex-row sm:items-center">
                    <div class="flex flex-col items-center flex-grow mb-16 mr-64 text-left md:items-start md:text-left md:mb-0">
                        <h1 class="mb-2 text-2xl font-semibold tracking-tighter text-left text-black sm:text-3xl title-font">
                            {{ $bit->name }}
                        </h1>
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
    </div>
</section>
