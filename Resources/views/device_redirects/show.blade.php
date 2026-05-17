@extends('layouts.app')

@section('content')
<div>
    <div class="content-header mb-3">
        <h1>Device Redirect Details</h1>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr><th colspan="2">Device Redirect Detaljer</th></tr>
        </thead>
        <tbody>
            <tr>
                <td width="150">ID</td>
                <td>{{ $deviceRedirect->id }}</td>
            </tr>
            <tr>
                <td>Navn</td>
                <td>{{ $deviceRedirect->name }}</td>
            </tr>
            <tr>
                <td>Platform</td>
                <td>
                    <span class="badge badge-info">{{ $deviceRedirect->platform }}</span>
                </td>
            </tr>
            <tr>
                <td>URL</td>
                <td>
                    <a href="{{ $deviceRedirect->url }}" target="_blank" class="text-break">
                        {{ $deviceRedirect->url }}
                    </a>
                </td>
            </tr>
            <tr>
                <td>Oprettet</td>
                <td>{{ $deviceRedirect->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td>Sidst opdateret</td>
                <td>{{ $deviceRedirect->updated_at->format('d/m/Y H:i') }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="text-right">
                    <a href="{{ route('device-redirects.edit', $deviceRedirect->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit mr-2"></i>Rediger
                    </a>
                    <a href="{{ route('device-redirects.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>Tilbage
                    </a>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection