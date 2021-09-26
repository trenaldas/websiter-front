<div x-data="{show: false}"
     x-init="@this.on('added', () => { show = true; setTimeout(() => {show = false; }, 2000) })"
     x-show.transition.opacity.out.duration.1500ms="show"
     style="display: none;"
     class="cursor-default mt-2 mr-2 fixed left-auto z-10 inset-0 rounded-xl flex shadow hover:shadow-md max-w-sm bg-black h-10 text-white"
>
    <div @click="show = false" class="mt-2 p-2 flex flex-col justify-center">
        <p class="text-base mb-2 font-bold">{{ __('The Item Has Been Added!') }}</p>
    </div>
</div>
