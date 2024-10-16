<?php

use Livewire\Volt\Component;

new class extends Component {
    // create a galery of products
}; ?>

<div>
    <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4 mt-4">
        @for ($i = 1; $i <= 8; $i++)
            @include('components.micro.genericCard', [
                'bg' => 'white',
                'buttonConfig' => null, #configuration for the button inside the card (object), default = $defaultBtConfig
                'btnCard' => true, #is the card a navigatable link? (boolean), default = false
                'cardHref' => null, #if the card is a link, where does it navigate to? (any string), default = 'javascript:void(0)'
                'addAttr' => null, #if the card is a link, should an attributes appended to the card? (string, html element attributes)
                'placeholder' => true, #is the card a placeholder? (boolean), default = true
                'cardImgUse' => false, #if the card isn't a placeholder, should the card have image?
                'cardImg' => null, #if the card have image, what's the url to the img?
                'cardImgAlt' => null, #if the card have image, what's the alt text?
            ])
        @endfor
    </div>
</div>
