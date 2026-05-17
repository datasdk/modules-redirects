@extends('layouts.app')

@section('actions')
    <a href="{{ route('redirect.create') }}" class="btn btn-primary">Opret Redirect</a>
@endsection

@section('content')
    <livewire:table 
        :config="Modules\Redirect\Tables\RedirectTable::class" 
    />
@endsection