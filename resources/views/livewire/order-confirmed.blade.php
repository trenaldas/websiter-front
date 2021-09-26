<div class="py-12">
    <div class="max-w-md mx-auto bg-gray-100 shadow-lg rounded-lg md:max-w-5xl">
        <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
            <div class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">
                    @if($confirmed)
                        {{ __('Order Has Been Placed And Confirmed') }}
                    @else
                        {{ __('The ordered has not been found.') }}
                    @endif
                    <br class="hidden lg:inline-block">
                </h1>
                <p class="mb-8 leading-relaxed">
                    @if($confirmed)
                        {{ __('Thanks for your order.') }}
                    @else
                        {{ __('Please contact us if the issue persists.') }}
                    @endif
                </p>
                <div class="flex justify-center">
                    <button wire:click="back" class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">{{ __('Back To Website') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
