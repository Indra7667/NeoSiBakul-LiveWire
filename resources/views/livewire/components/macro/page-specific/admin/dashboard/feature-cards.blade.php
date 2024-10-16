<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div class="w-full p-4 bg-gray-200 h-min">
    <x-micro.genericH1>
        Fitur Saya
    </x-micro.genericH1>
    <div class="grid grid-cols-4 gap-2">
        @for ($i = 1; $i <= 8; $i++)
            <x-micro.genericHorizontalCard bg="white" :buttonConfig='null' title='title' :btnCard='false'
                cardHref='javascript:void(0)' addAttr='' :placeholder='false' :cardImgUse='true' cardImgAlt=''
                :key='$i'>
                <div class="bg-gray-300 h-[1rem] w-full animate-pulse"></div>
                <x-slot:bottomSlot>
                    <x-micro.genericButton addAttr="" addClass='' brightness='500' color='green'
                        href='javascript:void(0)'>
                        Detail
                    </x-micro.genericButton>
                </x-slot>
            </x-micro.genericHorizontalCard>
        @endfor
    </div>
</div>