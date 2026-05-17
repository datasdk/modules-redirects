@extends('layouts.app')

@section('actions')
    <a href="{{ route('device-redirects.create') }}" class="btn btn-primary">
        <i class="fas fa-plus mr-1"></i> Opret Device Redirect
    </a>
@endsection

@section('content')
    <livewire:table 
        :config="Modules\Redirect\Tables\DeviceRedirectTable::class" 
    />
@endsection