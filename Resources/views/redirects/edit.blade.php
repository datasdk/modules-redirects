@extends('layouts.app')

@section('content')
<div>
    <div class="content-header mb-3">
        <h1>Rediger Redirect</h1>
    </div>

    <form method="POST" action="{{ route('redirect.update', $redirect->id) }}">
        @csrf
        @method('PUT')

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="2">Redirect Oplysninger</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>URL</td>
                    <td>
                        <input type="text" 
                               class="form-control @error('url') is-invalid @enderror" 
                               name="url" 
                               value="{{ old('url', $redirect->url) }}"
                               required
                               
                               placeholder="https://eksempel.dk/stil">
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            Den URL som brugeren skal omdirigeres til
                        </small>
                    </td>
                </tr>

                <tr>
                    <td width="150">Navn</td>
                    <td>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               name="name" 
                               value="{{ old('name', $redirect->name) }}"
                               required
                               disabled
                               >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            Unikt navn til at identificere denne redirect
                        </small>
                    </td>
                </tr>
                

            </tbody>
        </table>

  

        <div class="mt-4">

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-2"></i>Gem ændringer
            </button>

            <a href="{{ route('redirect.index') }}" class="btn btn-secondary">
                <i class="fas fa-times mr-2"></i>Annuller
            </a>
            
        </div>

    </form>


</div>
@endsection