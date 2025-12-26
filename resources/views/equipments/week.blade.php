@extends('layouts.app')

@section('title', "Jadwal Minggu ke-$weekNumber")

@section('contents')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Jadwal Pemeriksaan - Minggu ke-{{ $weekNumber }}
        </h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Alat</th>
                    <th>Lokasi</th>
                    <th>Kategori</th>
                    <th>Status Minggu {{ $weekNumber }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($equipments as $eq)
                    <tr>
                        <td>{{ $eq->name }}</td>
                        <td>{{ $eq->location }}</td>
                        <td>{{ $eq->category }}</td>
                        <td>
                            {{ $eq->weeks->first()->status ?? '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection