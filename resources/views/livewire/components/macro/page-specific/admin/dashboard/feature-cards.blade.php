<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div class="w-full p-4 bg-gray-200 h-[50vh]">
    <div class="grid grid-cols-4">
        @for ($i = 1; $i <= 8; $i++)
        <x-micro.genericCard bg="white" :buttonConfig='null' title='title' :btnCard='false' cardHref='javascript:void(0)' addAttr='' :placeholder='true' :cardImgUse='true' cardImgAlt='' :key='$i'>
            innerHtml for $slot
            <x-slot:bottomSlot>
            innerHml for $bottomSlot
            <x-slot>
        </x-micro.genericCard>
        @endfor
    </div>
</div>
