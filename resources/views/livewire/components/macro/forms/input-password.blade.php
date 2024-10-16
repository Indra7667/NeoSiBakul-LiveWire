<?php
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

/* 
    arguments (all of them are technically optional, but nice to have):
    <livewire:components.macro.forms.input-password 
    :key="'componentKey //String'" 
    addClassMain="anyClasses //String" 
    addClassInput='anyClasses //String'
    name = 'inputName' //String
    id = 'inputName' //String
    label = 'inputLabel' //String
    placeholder = 'inputPlaceholder' //String
    color = 'buttonColor' //tailwindClass
    />
    
    if the class isn't being read, check tailwind.config.js
    make sure the class is included in the safelist
    */

new class extends Component {
    public $passType = 'password'; // auto
    public $showSym = 'eye'; // auto
    public $addClassMain; // fillable, effects the container
    public $addClassInput; // fillable, effects the input
    public $name = 'password'; // fillable, name of the input
    public $id = 'password'; // fillable, id of the input
    public $label = 'Password'; // fillable, label of the input
    public $placeholder = '********'; // fillable, label of the input
    public $color = 'green-900'; // fillable, color of the button

    #[Validate(['required', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/'], message: ['regex' => ':attribute harus memiliki satu huruf besar, satu huruf kecil, dan satu angka',])]
    public $password = '';

    public function passTypeState(): void
    {
        $this->passType = $this->passType == 'password' ? 'text' : 'password';
        $this->showSym = $this->showSym == 'eye' ? 'eye-slash' : 'eye';
    }
};
?>

<div class="{{ $this->addClassMain }}">
    <x-input-label for="password" :value="__($this->label)" />
    <div class="flex w-full">
        <x-text-input wire:model.live="password" id="{{ $this->id }}"
            class="{{ $this->addClassInput }} block mt-1 w-5/6 lg:w-11/12 rounded-e-none" type="{{ $this->passType }}"
            name="{{ $this->name }}" required autocomplete="current-password" placeholder="{{$this->placeholder}}" />
        <x-primary-button class="bg-{{$this->color}} mt-1 w-1/6 lg:w-1/12 text-center rounded-s-none" type='button'
            wire:click='passTypeState'>
            <i class="bi bi-{{ $this->showSym }} w-full"></i>
        </x-primary-button>
    </div>
    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>
