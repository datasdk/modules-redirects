@extends('layouts.app')

@section('content')
<div>
    <div class="content-header mb-3">
        <h1>Opret Device Redirect</h1>
    </div>

    <form method="POST" action="{{ route('device-redirects.store') }}">
        @csrf

        <table class="table table-bordered">
            <thead>
                <tr><th colspan="2">Device Redirect Oplysninger</th></tr>
            </thead>
            <tbody>
                <tr>
                    <td width="150">Navn</td>
                    <td>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               name="name" 
                               value="{{ old('name') }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            Unikt navn til at identificere denne redirect
                        </small>
                    </td>
                </tr>
                <tr>
                    <td>Platform</td>
                    <td>
                        <select name="platform" 
                                class="form-control @error('platform') is-invalid @enderror" 
                                required>
                            <option value="">Vælg platform</option>
                            <option value="ios" {{ old('platform') == 'ios' ? 'selected' : '' }}>iOS</option>
                            <option value="android" {{ old('platform') == 'android' ? 'selected' : '' }}>Android</option>
                            <option value="web" {{ old('platform') == 'web' ? 'selected' : '' }}>Web</option>
        
                        </select>
                        @error('platform')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>URL</td>
                    <td>
                        <input type="text" 
                               class="form-control @error('url') is-invalid @enderror" 
                               name="url" 
                               value="{{ old('url') }}"
                               required
                               placeholder="https://eksempel.dk/sti">
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            Den URL som brugeren skal omdirigeres til
                        </small>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>Opret
                        </button>
                        <a href="{{ route('device-redirects.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-2"></i>Annuller
                        </a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>
</div>
@endsection