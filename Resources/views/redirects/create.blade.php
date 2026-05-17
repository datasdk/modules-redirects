@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Opret Redirect</div>
                <div class="card-body">
                    <form action="{{ route('redirect.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="text" name="url" id="url" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Gem</button>
                        <a href="{{ route('redirect.index') }}" class="btn btn-secondary">Annuller</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection