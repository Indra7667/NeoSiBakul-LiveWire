@once
    @php

        define('defaultCardBtConfig', [
            #non-editable
            'use' => false, # should button be added to the card
            'fill' => true, # fill the button with color or just outline
            'addAttr' => '', # add attributes to the button
            'addClass' => null, # add classes to the button
            'brightness' => null, # set the brightness of the button
            'color' => 'green', # set the color of the button (400, 500, 600)
            'href' => 'javascript:void(0)', # set the href of the button
            'label' => '', # set the text of the button
            'preIcon' => null, # add bootstrap icon before the label
            'postIcon' => null, # add bootstrap icon after the label
        ]); #for more information, check views/components/micro/genericButton.blade.php
        define('defaultCardImgConfig', [
            #non-editable
            'use' => false,
            'asset' => asset('core/images/notFound_green.png'),
            'alt' => 'image not found',
        ]);
    @endphp
@endonce
@php
    /*
    card I made is displayed in block,
    that means the width is 100% by default
    so you'll have to make the container yourself wherever you include this (use grid or whatever)

        arguments and template (all of them is technically optional, but nice to have):
        include('components.micro.genericCard',
        [
        'bg' => 'white', #bg color of the card
        'buttonConfig' => null, #configuration for the button inside the card (array), default = $defaultCardBtConfig
        'title' => '', # the title of the card (string), default = none
        'btnCard' => false, #is the card a navigatable link? (boolean), default = false
        'cardHref' => null, #if the card is a link, where does it navigate to? (any string), default = 'javascript:void(0)'
        'addAttr' => null, #if the card is a link, should an attributes appended to the card? (string, html element attributes)

        'placeholder' => true, #is the card a placeholder? (boolean), default = true
        'cardImgUse' => false, #if the card isn't a placeholder, should the card have image?
                    'cardImg' => null, #if the card have image, what's the url to the img?
        'cardImgAlt' => null, #if the card have image, what's the alt text?
    ])
    
    if the class isn't being read, check tailwind.config.js
    make sure the class is included in the safelist
*/

empty($btnCard) ? ($btnCard = false) : null; #is the card itself is a button
if ($btnCard) {
    # if the card itself is a button
    empty($cardHref) ? ($cardHref = 'javascript:void(0)') : null;

    # if the href is javascript:void(0), disable wire:navigate
    $wireNavigate = $cardHref == 'javascript:void(0)' ? '' : 'wire:navigate ';

    # set additional attributes to the card
    empty($addAttr) ? ($addAttr = $wireNavigate) : ($addAttr = $wireNavigate . $addAttr);
}

empty($placeholder) ? ($placeholder = true) : null;
empty($title) ? ($title = '<div class="bg-gray-300 h-[1rem] w-[50%] animate-pulse"></div>') : null;
empty($buttonConfig) ? ($buttonConfig = defaultCardBtConfig) : null;
empty($child) ? ($child = '<div class="bg-gray-300 h-[1rem] w-full animate-pulse"></div>') : null;

if (!$placeholder) {
    !isset($cardImgUse) ? ($cardImgUse = defaultCardImgConfig['use']) : null;
    if ($cardImgUse) {
        empty($cardImg) && !file_exist($cardImg) ? ($cardImg = defaultCardImgConfig['asset']) : null;
        empty($cardImgAlt) ? ($cardImgAlt = defaultCardImgConfig['alt']) : null;
    }
    $imgConfig = (object) [
        'use' => $cardImgUse,
        'asset' => $cardImg,
        'alt' => $cardImgAlt,
        ];
    }
@endphp

<div class="block bg-{{ $bg }} rounded-xl" wire:key="Card-{{ $title }}">
    @if ($btnCard)
        <a href="{{ $cardHref }}" {{ $addAttr }} class="group hover:scale-125">
    @endif
    <div class="block m-2">
        @if ($placeholder)
            <div class="bg-gray-300 h-40 w-full animate-pulse">
            </div>
        @else
            @if ($imgConfig->use)
                @if (!empty($imgConfig->asset))
                    <img src="{{ $imgConfig->asset }}" alt={{ $imgConfig->alt }} class="object-scale-down w-full" />
                @else
                    <div class="bg-gray-300 h-40 w-full animate-pulse">
                    </div>
                @endif
            @endif
        @endif
    </div>
    <div class="m-4">
        <div class="block mt-5">
            @if (!empty($title))
                <h4 class="w-full text-center font-bold text-lg flex justify-center">
                    {!! $title !!}
                </h4>
            @endif
            <p class="w-full text-center mt-1 h-max flex justify-center">
                <!-- how do I add child to a b:include? -->
                {!! $child !!}
            </p>
        </div>
    </div>
    <div class="m-4 bottom-0">
        @if ($buttonConfig['use'])
            <hr />
            <div class="flex justify-center">
                @include('components.micro.genericButton', $buttonConfig)
            </div>
        @endif
    </div>
    @if ($btnCard)
        </a>
    @endif
</div>
