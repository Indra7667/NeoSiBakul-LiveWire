<?php
/**
 * only intended to be used in landing
 * usage : <livewire:components.macro.page-specific.landing.navbar :key="'navbar'" />
 * */
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
// use function Livewire\Volt\{state};

new class extends Component {
    //
    public function mount()
    {
        $this->navigation = [(object) ['label' => 'Fasilitas', 'href' => '#fasilitas', 'current' => true], (object) ['label' => 'Layanan UKM', 'href' => '#layanan', 'current' => false], (object) ['label' => 'Konsultan', 'href' => '#konsultan', 'current' => false], (object) ['label' => 'Layanan Data', 'href' => '#data', 'current' => false], (object) ['label' => 'Infografi', 'href' => '#info', 'current' => false], (object) ['label' => 'Mitra', 'href' => '#mitra', 'current' => false], (object) ['label' => 'Berita', 'href' => '#berita', 'current' => false]];
        // state(['isGuest' => Auth::guest()]);
        $this->isAdmin = !empty(Auth::guard('admin')->user());
        $this->isGuest = Auth::guest();
    }
};
?>
<div class="sticky top-0 w-full bg-gradient-to-r from-green-100 via-green-300 to-green-100 min-h-[5vh] z-40">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class='relative flex h-16 items-center justify-between'>
            <div class="w-3/4 sm:w-1/2 md:w-1/3 lg:w-1/5 px-1" itemID='nav-logo'>
                <div class="w-full flex flex-1 items-center sm:items-stretch sm:justify-start">
                    <a class="w-full flex flex-shrink-0 items-center" href={{ route('index') }}>
                        <img alt="SiBakul" src="/core/images/system/logo-full.png" class="h-8 w-auto object-scale-down" />
                    </a>
                </div>
            </div>
            <div class="hidden lg:block md:w-1/3 lg:w-3/5 px-1" itemID='nav-buttons'>
                <div class="w-full grid grid-flow-col auto-cols-auto items-center text-nowrap px-1 lg-px-5">
                    @foreach ($this->navigation as $obj)
                        <div class="justify-center text-center" key={{ $obj->label }}>
                            @include('components.micro.genericTopbarButton', [
                                'color' => 'black',
                                'href' => $obj->href,
                                'label' => $obj->label,
                                'brightness' => 700,
                            ])
                        </div>
                        {{-- <div class="justify-center text-center" key={obj.label}>
              <a href={obj.href} class='text-gray-300  hover:text-gray-800 dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium'>{obj.label}</a>
            </div> --}}
                    @endforeach
                </div>
            </div>
            <div class="w-1/4 sm:w-1/2 md:w-1/3 lg:w-1/5 flex" itemID='nav-auth'>
                @if ($this->isGuest && !$this->isAdmin)
                    <div class="w-full grid auto-cols-max sm:grid-cols-2 gap-2 justify-center">
                        @include('components.micro.genericAButton', [
                            'fill' => false, #fill the button with color or just outline
                            'addAttr' => 'wire:navigate', #add attributes to the button
                            'addClass' => 'text-nowrap flex text-sm hidden xs:flex', #add classes to the button
                            'brightness' => 500, #set the brightness of the button (400, 500, 600), default: 500
                            'color' => 'blue', #set the color of the button (any color), default: blue
                            'href' => route('auth.login'), #set the href of the button (any string), default: javascript:void(0)
                            'label' => 'masuk', #set the text of the button (any string), (no default)
                            'preIcon' => 'box-arrow-in-right', #add bootstrap icon before the label (any string, bootstrap icon), (no default)
                            'postIcon' => null, #add bootstrap icon after the label (any string, bootstrap icon), (no default)
                        ])
                        @include('components.micro.genericAButton', [
                            'fill' => false, #fill the button with color or just outline
                            'addAttr' => '', #add attributes to the button
                            'addClass' => 'text-nowrap text-ellipsis overflow-hidden hidden sm:flex text-sm', #add classes to the button
                            'brightness' => 600, #set the brightness of the button (400, 500, 600), default: 500
                            'color' => 'green', #set the color of the button (any color), default: blue
                            'href' => 'javascript:void(0)', #set the href of the button (any string), default: javascript:void(0)
                            'label' => 'mendaftar', #set the text of the button (any string), (no default)
                            'preIcon' => 'plus', #add bootstrap icon before the label (any string, bootstrap icon), (no default)
                            'postIcon' => null, #add bootstrap icon after the label (any string, bootstrap icon), (no default)
                        ])
                        {{-- <GenericButton addClass='flex text-sm' bg='blue' href={coredata.routes.login.url} fill={false}>
                            <i class="bi bi-box-arrow-in-right items-center flex"></i> &nbsp;
                            <div class="hidden sm:block text-sm xl:text-base">{coredata.routes.login.label}</div>
                        </GenericButton> --}}
                        {{-- <GenericButton addClass='hidden sm:flex text-sm' bg='teal' href={coredata.routes.register.url} fill={false}>
                            <i class="bi bi-pencil-square items-center flex"></i> &nbsp;
                            <div class="hidden sm:block text-sm xl:text-base">{coredata.routes.register.label}</div>
                        </GenericButton> --}}
                    </div>
                @else
                    @include('components.micro.genericAButton', [
                        'href' => route('generic.logout'),
                        'fill' => false,
                        'color' => 'red',
                        'label' => 'logout',
                        'preIcon' => 'plus',
                        'addClass' => 'text-nowrap text-ellipsis overflow-hidden hidden sm:flex text-sm',
                    ])
                @endif
            </div>
        </div>
    </div>
</div>
