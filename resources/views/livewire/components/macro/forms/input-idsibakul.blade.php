<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

/* 
    arguments (all of them are technically optional, but nice to have):
    <livewire:components.macro.forms.input-idsibakul 
    :key="'componentKey //String'" 
    addClassMain="anyClasses //String" 
    addClassInput='anyClasses //String'
    name = 'inputName //String'
    id = 'inputName //String'
    label = 'inputLabel //String'
    placeholder = 'inputPlaceholder' //String
    />
    
    if the class isn't being read, check tailwind.config.js
    make sure the class is included in the safelist
    */

new class extends Component {
    public $addClassMain; // fillable, effects the container
    public $addClassInput; // fillable, effects the input
    public $name = 'idsibakul'; // fillable, name of the input
    public $id = 'idsibakul'; // fillable, id of the input
    public $label = 'ID SiBakul'; // fillable, label of the input
    public $placeholder = 'sb******'; // fillable, label of the input

    #[Validate(['required', 'min:8', 'regex:/[sb|SB][0-99999999]/u'], message: ['regex' => ':attribute harus berformat sb(angka) atau SB(angka)'])]
    public $idsibakul = '';
}; ?>

<div class="{{ $this->addClassMain }}">
    <x-input-label for="idsibakul" :value="__($this->label)" />
    <x-text-input wire:model.live="idsibakul" id="{{ $this->id }}" class="{{ $this->addClassInput }} block mt-1 w-full"
        type="text" name="{{ $this->name }}" required autofocus autocomplete="idsibakul"
        placeholder="{{ $this->placeholder }}" x-on:change="" />
    <x-input-error :messages="$errors->get('idsibakul')" class="mt-2" />
</div>
