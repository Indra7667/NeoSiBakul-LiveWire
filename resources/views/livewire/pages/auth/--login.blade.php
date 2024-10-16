<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rules\Password;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;
    public $remember;
    public $loginBt;

    public $isDisabled;

    public $passType = 'password';
    public $showSym = 'eye';

    #[Validate(['required', 'min:8', 'regex:/sb[0-99999999]/u'], message: ['regex' => ':attribute harus berformat sb(angka)'])]
    public $idSibakul = '';
    #[Validate(['password' => 'required'])]
    public $password = '';

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        dd($this->form);
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }

    public function passTypeState(): void
    {
        $this->passType = $this->passType == 'password' ? 'text' : 'password';
        $this->showSym = $this->showSym == 'eye' ? 'eye-slash' : 'eye';
    }
};
?>


<div>
    <div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form wire:submit="login">
            <div>
                <x-input-label for="idSibakul" :value="__('ID SiBakul')" />
                <x-text-input wire:model.live="idSibakul" id="idSibakul" class="block mt-1 w-full" type="text"
                    name="idSibakul" required autofocus autocomplete="idSibakul" placeholder="sbxxxxxxxx" x-on:change="" />
                <x-input-error :messages="$errors->get('idSibakul')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <div class="flex w-full">
                    <x-text-input wire:model.live="password" id="password" class="block mt-1 w-4/5 rounded-e-none"
                        type="{{ $this->passType }}" name="password" required autocomplete="current-password"
                        placeholder="********" />
                    <x-primary-button class="bg-green-900 mt-1 w-1/5 text-center rounded-s-none" type='button'
                        wire:click='passTypeState'>
                        <i class="bi bi-{{ $this->showSym }} w-full"></i>
                    </x-primary-button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="block mt-4">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="remember" id="remember" type="checkbox"
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="flex mt-4">
                <div class="flex justify-start">
                    <x-primary-navigation class="bg-yellow-500 ms-3" href="{{ route('index') }}" wire:navigate.hover>
                        kembali
                    </x-primary-navigation>
                </div>
                <div class="flex justify-end grow">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            href="{{ route('password.request') }}" wire:navigate>
                            {{ __('Lupa password?') }}
                        </a>
                    @endif

                    <x-primary-button class="bg-green-900 ms-3" wire:model='loginBt'>
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>
</div>
