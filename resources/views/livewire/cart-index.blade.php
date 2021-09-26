<div class="py-12">
    <div class="max-w-md mx-auto bg-gray-100 shadow-lg rounded-lg md:max-w-5xl">
        @if(! $ordered && count($cartItems) > 0)
            <div class="md:flex ">
                <div class="w-full p-4 px-5 py-5">
                    <div class="md:grid md:grid-cols-3 gap-2 ">
                        <div class="col-span-2 p-5">
                            <h1 class="text-xl font-medium ">{{ __('Shopping Cart') }}</h1>
                            @foreach($cartItems as $cart)
                                <div class="flex justify-between items-center mt-6 pt-6">
                                    <div class="flex items-center">
                                        <img src="@if($cart->bit->getFirstMedia()) {{ $cart->bit->getFirstMedia()->getFullUrl() }} @else {{ asset('img/no-photo.jpg') }} @endif" width="60" class="rounded-full">
                                        <div class="flex flex-col ml-3">
                                            <span class="md:text-md font-medium">{{ $cart->bit->name }}</span>
                                            <span class="text-xs font-light text-gray-400">#{{ $cart->bit->code }}</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-center items-center">
                                        <div class="pr-8 flex">
                                            <span wire:click="change({{ $cart->id }}, -1)" class="font-semibold cursor-pointer">-</span>
                                            <input type="text" disabled class="focus:outline-none bg-gray-100 border h-6 w-10 rounded text-sm px-1 mx-2" value="{{ $cart->quantity }}">
                                            <span wire:click="change({{ $cart->id }}, 1)" class="font-semibold cursor-pointer">+</span>
                                        </div>
                                        <div class="pr-8">
                                            <span class="text-xs font-medium">@money($cart->bit->price, $project->currency->name)</span>
                                        </div>
                                        <div>
                                            <i class="fa fa-close text-xs font-medium"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="flex justify-between items-center mt-6 pt-6 border-t">
                                <div class="flex items-center"> <i class="fa fa-arrow-left text-sm pr-2"></i>
                                    <span class="text-md font-medium text-purple-500"><a href="{{ route('home') }}">{{ __('Continue Shopping') }}</a></span>
                                </div>
                                <div class="flex justify-center items-end">
                                    <span class="text-sm font-medium text-gray-400 mr-1">{{ __('Total') }}:</span>
                                    <span class="text-lg font-bold text-gray-800 ">@money($totalCost, $project->currency->name)</span>
                                </div>
                            </div>
                        </div>
                        <div class=" p-5 bg-gray-800 rounded overflow-visible">
                            <form wire:submit.prevent="store">
                                <span class="text-xl font-medium text-gray-100 block pb-3">{{ __('Order Details') }}</span>
                                <div class="mb-2 flex justify-center flex-col pt-3">
                                    <input wire:model="name" type="text" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="{{ __('Name') }}">
                                    @error('name')
                                        <span class="text-xs text-red-600 dark:text-red-400">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <input id="last_name" wire:model="last_name" type="text" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="{{ __('Last Name') }}">
                                    @error('last_name')
                                        <span class="text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}
                                        </span>
                                    @enderror
                                    <input wire:model="email" type="text" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="{{ __('Email') }}">
                                    @error('email')
                                        <span class="text-xs text-red-600 dark:text-red-400">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <input wire:model="phone" type="text" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="{{ __('Phone') }}">
                                    @error('phone')
                                        <span class="text-xs text-red-600 dark:text-red-400">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <label for="street_name" class="mt-2 text-xs text-gray-400">{{ __('Address') }}</label>
                                    <input id="street_name" wire:model="street_name" type="text" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="{{ __('Street name - number') }}">
                                    @error('street_name')
                                        <span class="text-xs text-red-600 dark:text-red-400">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <label for="city" class="text-xs text-gray-400"></label>
                                    <input id="city" wire:model="city" type="text" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="{{ __('City') }}">
                                    @error('city')
                                        <span class="text-xs text-red-600 dark:text-red-400">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <label for="country" class="text-xs text-gray-400"></label>
                                    <input id="country" wire:model="country" type="text" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="{{ __('Country') }}">
                                    @error('country')
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <label for="details" class="text-xs text-gray-400"></label>
                                    <input id="details" wire:model="details" type="text" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="{{ __('Order Details') }}">
                                    @error('details')
                                        <span class="text-xs text-red-600 dark:text-red-400">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                @if($selectedMethod > 0)
                                    <div class="mb-4 flex justify-center flex-col pt-3">
                                        <label class="text-xs text-gray-400">{{ __('Shipping Method') }}</label>
                                        <select wire:model="selectedMethod" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600">
                                            @foreach($shippingMethods as $shippingMethod)
                                                <option value="{{ $shippingMethod->id }}">{{ $shippingMethod->name }} &euro; {{ number_format($shippingMethod->price / 100, 2) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <button type="submit" class="h-12 w-full bg-purple-500 rounded focus:outline-none text-white hover:bg-purple-600">{{ __('Submit Order') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(! $ordered)
            <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
                <div class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
                    <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">{{ __('Cart is empty') }}
                        <br class="hidden lg:inline-block">
                    </h1>
                    <p class="mb-8 leading-relaxed"></p>
                    <div class="flex justify-center">
                        <button wire:click="back" class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">{{ __('Back To Website') }}</button>
                    </div>
                </div>
            </div>
        @endif
        @if($ordered)
            <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
                <div class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
                    <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">{{ $project->cart_finish_success_title }}
                        <br class="hidden lg:inline-block">
                    </h1>
                    <p class="mb-8 leading-relaxed">{{ $project->cart_finish_success }}</p>
                    <div class="flex justify-center">
                        <button wire:click="back" class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">{{ __('Back To Website') }}</button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
