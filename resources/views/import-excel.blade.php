@extends('layouts.app')

@section('contents')
<div class="container">
    <h2>Upload File Excel</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" class="form-control mb-3" required>
        <button type="submit" class="btn btn-primary">Import</button>
    </form>
</div>
@endsection