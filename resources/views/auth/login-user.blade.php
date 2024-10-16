@extends('layouts.genericLayout')
@section('content')
    @if (auth()->guard('web')->user())
        @dd(auth()->guard('web')->user())
    @else
        {{-- @dd(auth()->guard('admin')) --}}
    @endif
    <div class="w-full min-h-screen flex justify-center items-center bg-green-100">
        <div class="relative w-fit h-fit bg-white p-8 rounded-xl">
            <div class="content w-[50vw]"></div>
            <p class="block text-center">login</p>
            <form action="{{ route('auth.login_post', ['as' => 'user']) }}" method="POST">
                @csrf
                <livewire:components.macro.forms.input-idsibakul :key="'idsibakul'" addClassMain="block mt-2" />
                <livewire:components.macro.forms.input-password :key="'password'" addClassMain="block mt-2" />
                <div class="grid grid-cols-2 gap-2">
                <x-micro.genericAButton addClass='mt-8' brightness='600' color='red' :href='route("index")'>
                    {{ __('Batal') }}
                </x-micro.genericButton>
                <x-micro.genericButton addAttr="" addClass='mt-8' brightness='600' color='green' type="submit">
                    login
                </x-micro.genericButton>
                </div>
            </form>
        </div>
    </div>
@endsection
