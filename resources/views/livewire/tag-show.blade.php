<div>
    @foreach($tag->bits as $bit)
        @include("bit-theme.{$bit->bitTheme->blade}")
    @endforeach
</div>
@include('components.item-added-notification')
