@php
    if(empty($addClass)){
        $addClass = '';
    }
    if (empty($brightness) || !is_int($brightness)) {
        $brightness = 500;
    } if ($brightness < 400) {
        $brightness = 400;
    } if ($brightness > 700) {
        $brightness = 700;
    }
    $color = empty($color)? 'gray' : $color;

    $brighter100 = $brightness-100 <= 100 ? 100 : $brightness-100;
    $brighter200 = $brightness-200 <= 100 ? 100 : $brightness-200;
    $brighter300 = $brightness-300 <= 100 ? 100 : $brightness-300;
    $darker100 = $brightness+100 >= 900 ? 900 : $brightness+100;
    $darker200 = $brightness+200 >= 900 ? 900 : $brightness+200;
    $darker300 = $brightness+300 >= 900 ? 900 : $brightness+300;
@endphp
<a href={{$href}} class="{{$addClass}} text-{{$color}}-{{$brighter200}} hover:text-{{$color}}-{{$darker300}} target:text-{{$color}}-{{$darker300}} dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium">
    {{$label}}
</a>