<div>
{{--    <h1 class="px-60 sm:px-0 mb-8 text-2xl font-medium tracking-tighter text-center text-black text-left lg:text-4xl title-font">--}}
{{--        {{ $bit->name }}--}}
{{--    </h1>--}}
    @foreach($bit->childrenBits as $bit)
        @include("bit-theme.{$bit->bitTheme->blade}")
    @endforeach
</div>
@include('components.item-added-notification')
