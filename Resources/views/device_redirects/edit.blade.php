@extends('layouts.app')

@section('content')
<div>
    <div class="content-header mb-3">
        <h1>Rediger Device Redirect</h1>
    </div>

    <form method="POST" action="{{ route('device-redirects.update', $deviceRedirect->id) }}">
        @csrf
        @method('PUT')

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
                               value="{{ old('name', $deviceRedirect->name) }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>Platform</td>
                    <td>
                        <select name="platform" 
                                class="form-control @error('platform') is-invalid @enderror" 
                                required>
                            <option value="ios" {{ old('platform', $deviceRedirect->platform) == 'ios' ? 'selected' : '' }}>iOS</option>
                            <option value="android" {{ old('platform', $deviceRedirect->platform) == 'android' ? 'selected' : '' }}>Android</option>
                            <option value="web" {{ old('platform', $deviceRedirect->platform) == 'web' ? 'selected' : '' }}>Web</option>
                          
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
                               value="{{ old('url', $deviceRedirect->url) }}"
                               required>
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>ID</td>
                    <td class="text-muted">{{ $deviceRedirect->id }}</td>
                </tr>
                <tr>
                    <td>Oprettet</td>
                    <td class="text-muted">{{ $deviceRedirect->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <td>Sidst opdateret</td>
                    <td class="text-muted">{{ $deviceRedirect->updated_at->format('d/m/Y H:i') }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>Gem ændringer
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