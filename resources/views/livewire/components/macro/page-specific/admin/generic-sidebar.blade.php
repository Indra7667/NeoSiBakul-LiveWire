<?php

use Livewire\Volt\Component;

new class extends Component {
    //
    public $mode = 1;
    public $width = 16;
    public $allowPlus;
    public $allowMinus;
    public $hide;
    public $features;

    public function mount()
    {
        $this->features = [
            self::generateFeatures('dashboard', '/core/cdn/bootstrap-icons-1.11.3/icons/house.svg'),
            self::generateFeatures('feature1', '/core/cdn/bootstrap-icons-1.11.3/icons/1-circle.svg'),
            self::generateFeatures('feature2', '/core/cdn/bootstrap-icons-1.11.3/icons/2-circle.svg'),
        ];
    }

    public function handleChange(string $action): void
    {
        $action == 'plus' ? $this->mode++ : $this->mode--;
        $this->hide = '';
        switch ($this->mode) {
            case 0:
                $this->width = 0;
                $this->allowMinus = 'disabled';
                $this->hide = 'hidden';
                break;
            case 1:
                $this->width = 16;
                $this->allowMinus = '';
                $this->allowPlus = '';
                break;
            case 2:
                $this->width = 32;
                $this->allowPlus = 'disabled';
                break;
        }
    }

    public function generateFeatures(string $name, string $icon){
        $feature = (object)['name'=>$name, 'icon'=>$icon];
        return $feature;
    }
}; ?>
<div class="">
    <div class="fixed flex left-0 w-fit h-screen overflow-auto">
        <div class="bg-gray-200 w-{{ $this->width }} min-h-screen {{$this->hide}}" part="main">
            <div class="grid grid-cols-1 gap-2 w-100">
                @foreach ($this->features as $feature)
                <div class="aspect-square flex">
                    <div class="w-1/2 h-1/2 m-auto">
                        <img class="aspect-square w-full" src="{{$feature->icon}}" alt="{{$feature->name}}">
                    </div>
                </div>                    
                @endforeach
            </div>
        </div>
        <div class="h-full w-fit flex" part="btContainer">
            <div class="block my-auto">
                <div class="grid grid-cols-1 divide-y h-32 w-3 my-auto divide-solid divide-black">
                    <div class="">
                        <button class="h-full w-full rounded-tr-lg flex bg-gray-200" wire:click='handleChange("plus")'
                            {{ $this->allowPlus }}>
                            <span class="inline-block w-full my-auto align-middle">
                                >
                            </span>
                        </button>
                    </div>
                    <div class="">
                        <button class="h-full w-full rounded-br-lg flex bg-gray-200" wire:click='handleChange("minus")'
                            {{ $this->allowMinus }}>
                            <span class="inline-block w-full my-auto align-middle">
                                < </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
