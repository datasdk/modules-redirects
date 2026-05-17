@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Redirect Details</div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">ID:</dt>
                        <dd class="col-sm-9">{{ $redirect->id }}</dd>
                        
                        <dt class="col-sm-3">Name:</dt>
                        <dd class="col-sm-9">{{ $redirect->name }}</dd>
                        
                        <dt class="col-sm-3">URL:</dt>
                        <dd class="col-sm-9">
                            <a href="{{ $redirect->url }}" target="_blank">
                                {{ $redirect->url }}
                            </a>
                        </dd>
                        
                        <dt class="col-sm-3">Created:</dt>
                        <dd class="col-sm-9">{{ $redirect->created_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                    <div class="mt-3">
                        <a href="{{ route('redirect.edit', $redirect->id) }}" class="btn btn-primary">Rediger</a>
                        <a href="{{ route('redirect.index') }}" class="btn btn-secondary">Tilbage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection