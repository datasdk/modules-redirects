@php

    use Illuminate\Support\Str;
    
    $url = url('/redirect/forward/device/' . $deviceRedirect->name);

@endphp

<div class="device-redirect-url">

    <span class="truncate max-w-xs">
        {{ $url }}
    </span>
 
</div>
