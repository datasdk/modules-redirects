@php

    use Illuminate\Support\Str;
    
    $forwardUrl = url('/redirect/forward/device/' . $deviceRedirect->name);

@endphp


<span class="truncate max-w-xs">
    {{ $forwardUrl }} <a href="{{ $forwardUrl }}" target="_blank"><i class="fas fa-chevron-right ml-2"></i></a>
</span>
