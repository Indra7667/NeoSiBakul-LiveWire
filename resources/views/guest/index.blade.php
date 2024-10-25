@extends('layouts.genericLayout')
@section('content')
    @once
        @php
            function fasilitasBt($href)
            {
                $return = [
                    'use' => true, # should button be added to the card
                    'fill' => true, # fill the button with color or just outline
                    'addAttr' => '', # add attributes to the button
                    'addClass' => 'justify-center', # add classes to the button
                    'brightness' => null, # set the brightness of the button
                    'color' => 'green', # set the color of the button (400, 500, 600)
                    'href' => $href, # set the href of the button
                    'label' => 'selengkapnya', # set the text of the button
                    'preIcon' => null, # add bootstrap icon before the label
                    'postIcon' => null, # add bootstrap icon after the label
                ];
                return $return;
            }
            function fasilitasCard($title, $detail, $href, $img, $alt)
            {
                $return = [
                    'bg' => 'white',
                    'title' => $title, # the title of the card (string), default = none
                    'buttonConfig' => fasilitasBt($href), # configuration for the button inside the card (array), default = $defaultBtConfig
                    'child' => $detail,
                    'btnCard' => true, # is the card a navigatable link? (boolean), default = false
                    'cardHref' => null, # if the card is a link, where does it navigate to? (any string), default = 'javascript:void(0)'
                    'addAttr' => null, # if the card is a link, should an attributes appended to the card? (string, html element attributes)
                    'placeholder' => false, # is the card a placeholder? (boolean), default = true
                    'cardImgUse' => false, # should the card have image (boolean), default = false
                    'cardImg' => null, # what's the url to the img (string, url), default = false
        'cardImgAlt' => null, # what's the alt text (string), default = null
                ];
                return $return;
            }
        @endphp
    @endonce
    @php
        $prop = [];
        $prop['fasilitas'] = [
            fasilitasCard(
                'sibakul MarketHUB',
                'Temukan produk kreatif dari Koperasi dan UMKM DIY',
                'javascript:void(0)',
                null,
                null,
            ),
            fasilitasCard(
                'Galeri Pasar KotaGede',
                'Temukan produk Unggul Galeri Pasar Kotagede YIA',
                'javascript:void(0)',
                null,
                null,
            ),
            fasilitasCard(
                'Galeri PLUT',
                'Temukan produk Unggul Galeri PLUT di beberapa lokasi',
                'javascript:void(0)',
                null,
                null,
            ),
            fasilitasCard(
                'Teras Malioboro',
                'Temui Para Pedagang Khas Jogja di Teras Malioboro',
                'javascript:void(0)',
                null,
                null,
            ),
        ];
    @endphp

    <livewire:components.macro.page-specific.landing.navbar :key="'navbar'" />
    <div class="w-full px-1 py-4 bg-slate-100">
        <div class="w-full flex justify-center" id="welcome">
            <div class="w-[90%] bg-yellow-100 p-5 rounded-xl">
                <div class="block">
                    <div class="bg-gray-300 aspect-[4/1] w-full rounded-xl animate-pulse">
                    </div>
                </div>
                <div class="flex justify-center">
                    <img src="/core/images/system/index-welcome.png" class='object-scale-down w-full' alt="welcome to SiBakul"
                        srcSet="" />
                </div>
            </div>
        </div>
        <div class="w-full flex justify-center mt-4" id="layanan">
            <div class="w-[90%]">
                <div class="block">
                    <x-micro.genericH1>
                        Fasilitas Pemasaran Produk UMKM DIY
                    </x-micro.genericH1>
                </div>
                <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4 mt-4">
                    @foreach ($prop['fasilitas'] as $fasilitas)
                        {{-- @include('components.micro.genericCard', $fasilitas) --}}
                        <x-micro.genericCard bg='white' title='' :btnCard="false" :cardHref="null" addAttr='' :placeholder="true" :cardImgUse="false" :cardImg="null" :cardImgAlt="null">
                            {{-- {{$fasilitas}} --}}
                            <x-slot:slot_bottom>
                                <x-micro.genericAButton fill addAttr="" addClass='' brightness='500' color='blue' href='javascript:void(0)'>
                                    Detail
                                </x-micro.genericAButton>
                            </x-slot:slot_bottom>
                        </x-micro.genericCard>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="w-full flex justify-center mt-4" id="layanan">
            <livewire:components.macro.page-specific.landing.menu-tray :key="'layanan-tray'" lazy />
        </div>
{{-- 
        <div class="w-full flex justify-center mt-4" id="products">
            <div class="w-[90%] bg-green-300 rounded-xl p-4">
                <div class="block">
                    @include('components.micro.genericH1', ['text' => 'Promosi Produk Markethub'])
                </div>
                <livewire:components.macro.global.list-produk-nopage :key="'produk-random'" lazy />
            </div>
        </div>

        <div class="w-full flex justify-center mt-4" id="konsultan">
            <div class="w-[90%]">
                <livewire:components.macro.page-specific.landing.konsultan-carousel :key="'konsultan-component'" lazy />
            </div>
        </div>
    </div> --}}
@endsection
