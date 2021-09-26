<div class="flex flex-row-reverse">
    <div slot="icon" class="relative">
        @if($cartCount > 0)
            <div class="absolute text-xs rounded-full -mt-1 -mr-1 px-1 font-bold top-0 right-0 bg-red-700 text-white">{{ $cartCount }}</div>
        @endif
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart w-6 h-6 mt-2">
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
        </svg>
    </div>
</div>
