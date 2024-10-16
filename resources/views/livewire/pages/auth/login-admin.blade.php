<?php

use App\Livewire\Forms\LoginFormAdmin;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rules\Password;

new #[Layout('layouts.guest')] class extends Component {
    public LoginFormAdmin $form;

    public $remember;
    public $loginBt;

    public $isDisabled;

    public $passType = 'password';
    public $showSym = 'eye';

    #[Validate(['required', 'min:8'])]
    public $username = '';
    #[Validate(['password' => 'required'])]
    public $password = '';

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        // $this->validate();
        // dd($this);
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        // dd($this->username, $this->password);
        $this->form->Username = $this->username;
        $this->form->password = $this->password;
        $this->form->authenticate();
        if (!empty(Auth()->guard('admin')->user())) {
            $this->redirectRoute('admin-index');
        } else {
            dd(Auth::guard('admin'));
        }
        // if (Auth::guard('admin')->attempt(['username' => $this->username, 'password' => $this->password])) {
        //     dd($this->form);
        //     $this->form->authenticate();
        //     Session::regenerate();
        // $this->redirectRoute('admin-index');
        //     // $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
        // }
        // dd(Auth::guard('admin')->attempt(['username' => $this->username, 'password' => $this->password]));
        // dd(Auth()->guard('admin')->user());
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
        @auth
            @dd(auth()->user())
        @endauth
        @if (!empty(Auth()->guard('admin')->user()))
            @dd(Auth()->guard('admin')->user())
        @endif
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form wire:submit="login">
            <div>
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input wire:model.live="username" id="username" class="block mt-1 w-full" type="text"
                    name="username" required autofocus autocomplete="username" placeholder="username" x-on:change="" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
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
