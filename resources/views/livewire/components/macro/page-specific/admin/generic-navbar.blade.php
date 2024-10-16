<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public $username;
    public function mount()
    {
        $this->username = auth::guard('admin')->user()->username;
    }
}; ?>

<div class="sticky top-0 w-full bg-gradient-to-r from-green-300 via-green-200 to-green-300 min-h-[5vh] z-40">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class='relative flex h-16 items-center justify-between'>
            <div class="w-3/4 sm:w-1/2 md:w-1/3 lg:w-1/5 px-1" itemID='nav-logo'>
                <div class="w-full flex flex-1 items-center sm:items-stretch sm:justify-start">
                    <a class="w-full flex flex-shrink-0 items-center" href={{ route('admin.index') }}>
                        <img alt="SiBakul" src="/core/images/system/logo-full.png" class="h-8 w-auto object-scale-down" />
                    </a>
                </div>
            </div>
            <div class="hidden lg:block w-1/4 smw-1/2 md:w-2/3 lg:w-3/5 px-1" itemID='nav-user'>
                {{-- <div class="flex w-full"> --}}
                <button class="w-full">
                    <div class="flex w-full justify-center text-center">
                        <span class="font-semibold">
                            {{ $this->username }}
                        </span>
                    </div>
                    <div class="flex w-full justify-center text-center">
                        <span class="font-xthin">
                            <i class="bi bi-pencil"></i> edit
                        </span>
                    </div>
                </button>
                {{-- </div> --}}
            </div>
            <div class="w-1/4 sm:w-1/2 md:w-1/3 lg:w-1/5 flex" itemID='nav-auth'>
                @include('components.micro.genericAButton', [
                    'href' => route('generic.logout'),
                    'fill' => false,
                    'color' => 'red',
                    'label' => 'logout',
                    'preIcon' => 'plus',
                    'addClass' => 'text-nowrap text-ellipsis overflow-hidden hidden sm:flex text-sm',
                ])
            </div>
        </div>
    </div>
</div>
