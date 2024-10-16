@php
    /* 
    arguments (all of them are technically optional, but nice to have):
    
    include('components.micro.genericButton',
    [
    'fill' => true,#fill the button with color or just outline
    'addAttr' => null,#add attributes to the button
    'addClass' => null,#add classes to the button
    'brightness' => 500,#set the brightness of the button (400, 500, 600), default: 500
    'color' => 'blue',#set the color of the button (any color), default: blue
    'type' => 'button',#the type of the button
    'label' => 'label',#set the text of the button (any string), (no default)
    'preIcon' => null,#add bootstrap icon before the label (any string, bootstrap icon), (no default)
    'postIcon' => null,#add bootstrap icon after the label (any string, bootstrap icon), (no default)
    ])

    or:
    <x-micro.genericButton fill addAttr="" addClass='' brightness='500' color='blue' href='javascript:void(0)'>
        innerHTML
    </x-micro.genericButton>
    
    if the class isn't being read, check tailwind.config.js
    make sure the class is included in the safelist
    */

    if(empty($color)){
        $color = 'blue';
    }

    if (empty($fill)) {
        $fill = false;
    }

    if (empty($addClass)) {
        $addClass = '';
    }

    if (empty($brightness) || !is_int($brightness)) {
        $brightness = 500;
    } if ($brightness < 400) {
        $brightness = 400;
    } if ($brightness > 600) {
        $brightness = 600;
    }
    
    if (empty($type)) {
        $type = 'button';
    }

    if (empty($addAttr)) {
        $addAttr = '';
    }

    if (empty($label) && empty($slot)) {
        $slot = 'label';
    } else {
        $slot = empty($slot)? $label : $slot;
    }

    $brighter100 = $brightness-100 <= 100 ? 100 : $brightness-100;
    $brighter200 = $brightness-200 <= 100 ? 100 : $brightness-200;
    $brighter300 = $brightness-300 <= 100 ? 100 : $brightness-300;
    $darker100 = $brightness+100 >= 900 ? 900 : $brightness+100;
    $darker200 = $brightness+200 >= 900 ? 900 : $brightness+200;
    $darker300 = $brightness+300 >= 900 ? 900 : $brightness+300;

    $class_base = "{$addClass} flex py-1 px-2 sm:py-2 hover:bg-{$color}-{$darker200} focus:ring-{$color}-{$brightness} focus:ring-offset-{$color}-{$brighter300} text-{$color}-{$brighter300} w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:border-none focus:ring-2 focus:ring-offset-2 rounded-lg item-center justify-center ";
    if ($fill) {
        # code...
        $class_plus = "bg-{$color}-{$darker100} focus:ring-{$color}-{$brightness} focus:ring-offset-{$color}-{$brighter300} text-{$color}-{$brighter300}";
    } else {
        # code...
        $class_plus = "box-border border-{$color}-{$darker100} hover:border-{$color}-{$darker200} border-2 text-{$color}-{$brightness} hover:text-{$color}-{$brighter300}";
    }
    $class = $class_base . $class_plus;
@endphp

<button type="{{$type}}" class="{{ $class }}" {{ $addAttr }}>
    <p class="w-full">
        @if (!empty($preIcon))
            <i class="bi bi-{{$preIcon}}"></i> &nbsp;
        @endif
        {!!$slot!!}
        @if (!empty($postIcon))
            &nbsp; <i class="bi bi-{{$postIcon}}"></i>
        @endif
    </p>
</button>
