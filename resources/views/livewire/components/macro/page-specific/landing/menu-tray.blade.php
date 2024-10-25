<?php
/**
 * only intended to be used in landing
 * usage: <livewire:components.macro.page-specific.landing.menu-tray :key="'layanan-tray'" />
 *
 * */
use Livewire\Volt\Component;

new class extends Component {
    //
    public $selected = 'SiBakul';

    public $items = [];

    public $version = 2;

    public $traychild;

    public function create_child($name = null, $href = null, $icon = null, $navigate = false)
    {
        $asset = empty($icon) ? asset('/core/images/system/notFound_green.png') : $icon;
        $return = (object) [
            'name' => 'template',
            'href' => 'javascript:void(0)',
            'icon' => '/core/images/system/notFound_green.png',
            'navigate' => false,
        ];
        empty($name) ?: ($return->name = $name);
        empty($href) ?: ($return->href = $href);
        empty($icon) ?: ($return->icon = $asset);
        empty($navigate) ?: ($return->navigate = $navigate);
        return $return;
    }

    public function mount()
    {
        $this->items['SiBakul'] = [$this->create_child('cek keanggotaan', null, asset('/core/images/logo/logo_cek_keanggotaan_notext.png')), $this->create_child('ubah password', null, asset('/core/images/logo/logo_ubah_password_notext.png')), $this->create_child('registrasi', null, asset('/core/images/logo/logo_registrasi_notext.png')), $this->create_child('login', null, asset('/core/images/logo/logo_login_notext.png')), $this->create_child('panduan', null, asset('/core/images/logo/logo_panduan_notext.png')), $this->create_child('konsultasi', null, asset('/core/images/logo/logo_sibakul_live_chat.png')), $this->create_child('pelatihan', null, asset('/core/images/logo/logo_pelatihan_notext.png')), $this->create_child('foto produk', null, asset('/core/images/logo/logo_layanan_foto_produk_notext.png'))];
        $this->items['Pembinaan'] = [$this->create_child('klinik koperasi', null, asset('/core/images/logo/logo_layanan_foto_produk_notext.png')), $this->create_child('SiBakul UMKM', null, asset('/core/images/logo/logo_sibakul.png')), $this->create_child('Desa Preneur', null, asset('/core/images/logo/logo_desa_preneur.jpg')), $this->create_child('NIB', null, asset('/core/images/logo/logo_nib.png')), $this->create_child('Halal', null, asset('/core/images/logo/logo_halal.png')), $this->create_child('PIRT', null, asset('/core/images/logo/logo_pirt.png')), $this->create_child('MD', null, asset('/core/images/logo/logo_badan_pom.png')), $this->create_child('HAKI & Jogjamark', null, asset('/core/images/logo/logo_jogjamark.png'))];
        $this->items['Data'] = [$this->create_child('Data UKM', null, asset('/core/images/logo/logo_ladaku_ukm.jpg')), $this->create_child('Data Koperasi', null, asset('/core/images/logo/logo_klinik_koperasi.jpg')), $this->create_child('MarketHUB', null, asset('/core/images/logo/logo_data_markethub.jpg')), $this->create_child('PKG YIA', null, asset('/core/images/logo/logo_pkg.jpg')), $this->create_child('Teras Malioboro', null, asset('/core/images/logo/logo_teras_malioboro.jpeg')), $this->create_child('Desa Preneur', null, asset('/core/images/logo/logo_desa_preneur.jpg')), $this->create_child('Bantu Banting', null, asset('/core/images/logo/logo_bantu_banting.png')), $this->create_child('Direktori UKM', null, asset('/core/images/logo/logo_direktori_ukm.jpg'))];
        $this->items['Kolaborasi'] = [$this->create_child('BantuBanting', null, asset('/core/images/logo/logo_bantu_banting.png')), $this->create_child('Olah Data UMKM', null, asset('/core/images/logo/logo_data_ukm.jpg')), $this->create_child('Kurasi PKG YIA', null, asset('/core/images/logo/logo_pkg.jpg')), $this->create_child('Admin Teras Malioboro', null, asset('/core/images/logo/logo_teras_malioboro.jpeg')), $this->create_child('BAGI DATA', null, asset('/core/images/logo/logo_restapi.jpg')), $this->create_child('SiBakul SRC', null, asset('/core/images/logo/logo_sibakul_SRC.jpg')), $this->create_child('Toko ATG', null, asset('/core/images/logo/logo_toko_atg.jpg')), $this->create_child('DIFAMART', null, asset('/core/images/logo/logo_difamart.png'))];
    }

    public function changeSelected($to)
    {
        $this->selected = $to;
    }
}; ?>

<div class="w-[90%] h-max bg-gradient-to-r from-green-500 via-green-400 to-green-500 rounded-xl p-4">
    <div class="block">
        <x-micro.genericH1>
            layanan {{$this->selected}}
        </x-micro.genericH1>
    </div>
    <div class="w-full flex box-border border-2 rounded-lg h-full border-black">
        <div class="bg-green-500 w-1/4 rounded-s-lg">
            <div class="w-full grid grid-cols-1 rounded-s-lg">
                @foreach ($this->items as $name => $item)
                    <button
                        x-bind:class="'{{ $this->selected }}' == '{{ $name }}' ? 'w-100 bg-green-600 py-6 rounded-lg' :
                        'w-100 py-6'"
                        wire:click='changeSelected("{{ $name }}")' :key='{{ $name }}'>
                        <p class="text-lg font-mono font-bold">
                            {{ $name }}
                        </p>
                    </button>
                @endforeach
            </div>
        </div>
        <div class="bg-green-200 w-3/4 rounded-e-lg">
            @if ($this->version == 1)
                <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-4 p-4">
                    @foreach ($this->items[$this->selected] as $item)
                        <div class="w-100 bg-gray-200 aspect-square p-4 rounded-xl">
                            <div class="w-100">
                                <img class="object-scale-down rounded-lg bg-white p-2 lg:p-4" src="{{ $item->icon }}"
                                    alt="{{ $item->name }}" loading="lazy">
                            </div>
                            <div class="w-100 text-center mt-2">
                                {{ $item->name }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            @if ($this->version == 2)
                {{-- version2 --}}
                @foreach ($this->items as $key => $group)
                    <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-4 p-4 {{ $key == $this->selected ?: 'hidden' }}">
                        @foreach ($group as $item)
                            <div class="w-100 bg-gray-200 aspect-square p-4 rounded-xl">
                                <div class="w-100">
                                    <img class="object-scale-down rounded-lg bg-white p-2 lg:p-4"
                                        src="{{ $item->icon }}" alt="{{ $item->name }}" loading="lazy">
                                </div>
                                <div class="w-100 text-center mt-2">
                                    {{ $item->name }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
{{-- <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-4">
    @foreach ($this->items as $name => $item)
    <div class="">
        {{ $item->name }}
    </div>
    @foreach ($item->children as $child)
    <div class="">
        {{ $child->name }}
    </div>
    @endforeach
    @endforeach
</div> --}}
