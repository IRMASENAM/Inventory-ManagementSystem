<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Barang Keluar | Sistem EKSINTAS</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 25mm 20mm 30mm 20mm; /* beri ruang ekstra di bawah */
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #000;
            position: relative;
            min-height: 100%;
        }

    /* HEADER */
    .kop-surat {
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 3px solid #0072bb;
        margin-bottom: 20px;
        padding-bottom: 10px;
        position: relative;
        gap: 10px;
    }

    .kop-surat img {
        width: 70px;
        height: auto;
    }

    .kop-teks {
        text-align: center;
        flex: 1;
    }

    .kop-teks h2 {
        color: #0072bb;
        margin: 0;
        font-size: 15px;
        font-weight: bold;
    }

    .kop-teks h3 {
        margin: 2px 0;
        font-size: 12.5px;
        color: #333;
        font-weight: 600;
    }

    .kop-teks p {
        margin: 0;
        font-size: 10.5px;
        color: #555;
    }

        /* TABEL DATA */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        th, td {
            border: 1px solid #aaa;
            padding: 6px 8px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background: #0072bb;
            color: white;
            font-weight: bold;
            font-size: 12px;
        }

        tr:nth-child(even) {
            background-color: #f6faff;
        }

        /* TOTAL */
        .summary {
            margin-top: 15px;
            background-color: #eaf5ff;
            border-left: 4px solid #0072bb;
            padding: 6px 10px;
            font-size: 12px;
            display: inline-block;
            font-weight: bold;
        }

        /* TANDA TANGAN SELALU DI BAWAH */
        .ttd-container {
            position: fixed;
            bottom: 70px; /* jarak dari bawah halaman */
            left: 0;
            width: 100%;
        }

        .ttd {
            width: 100%;
            text-align: center;
            border-collapse: collapse;
        }

        .ttd td {
            width: 50%;
            border: none;
            vertical-align: top;
            padding: 6px 10px;
        }

        .ttd .jabatan {
            font-size: 12px;
            font-weight: 500;
        }

        .ttd .sub-jabatan {
            font-size: 11px;
            font-style: italic;
            color: #444;
        }

        .ttd .nama {
            font-weight: bold;
            text-decoration: underline;
            font-size: 12px;
            padding-top: 10px;
        }

        .ttd .nama::before {
            content: "";
            display: block;
            margin: 0 auto 5px auto;
            width: 60%;
            height: 0.5px;
            background-color: #0072bb;
        }

        /* FOOTER CETAK */
        .footer {
            position: fixed;
            bottom: 20px;
            right: 0;
            left: 0;
            text-align: right;
            font-size: 11px;
            color: #666;
            border-top: 2px solid #0072bb;
            padding-top: 4px;
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
<div class="kop-surat">
    <img src="{{ public_path('admin_assets/img/adp.jpg') }}" alt="Logo PLN">
    <div class="kop-teks">
        <h2>PT PLN INDONESIA POWER UBP JAWA TENGAH 2 ADIPALA</h2>
        <h3>Unit Bisnis Pembangkitan — EKSINTAS</h3>
        <p>Area Sawah/Ladang, Bunton, Kec. Adipala, Kab. Cilacap, Jawa Tengah, 53271, Indonesia</p>
    </div>
</div>

    {{-- JUDUL --}}
    <div class="laporan-title">
        <h4>LAPORAN BARANG KELUAR</h4>
        <div class="periode">
            Periode :
            @if(request('bulan') || request('tahun'))
                {{ request('bulan') ? DateTime::createFromFormat('!m', request('bulan'))->format('F') : 'Semua Bulan' }}
                {{ request('tahun') ?? date('Y') }}
            @else
                Semua Periode
            @endif
        </div>
    </div>

    {{-- TABEL --}}
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Transaksi</th>
                <th>Tanggal Keluar</th>
                <th>Nama Barang</th>
                <th>Jumlah Keluar</th>
                <th>Nomor POD (Tujuan)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($LaporanKeluar as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->no_transaksi }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tgl_keluar)->format('d/m/Y') }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->jumlah_keluar }}</td>
                    <td>{{ $item->nomor_pod ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada data barang keluar</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- TOTAL --}}
    <div class="summary">
        Total Transaksi: {{ count($LaporanKeluar) }} data
    </div>

    {{-- TANDA TANGAN FIX DI BAWAH --}}
    <div class="ttd-container">
        <table class="ttd">
            <tr>
                <td class="jabatan">Mengetahui,</td>
                <td class="jabatan">Adipala, {{ now()->format('d F Y') }}</td>
            </tr>
            <tr>
                <td class="sub-jabatan">Assistant Manager Efisiensi, Kinerja & Sistem Informasi</td>
                <td class="sub-jabatan">&nbsp;</td>
            </tr>
            <tr><td colspan="2" style="height: 50px;"></td></tr>
            <tr>
                <td class="nama">Heru Monas Prasetyo</td>
                <td class="nama">Tim Eksis</td>
            </tr>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        Dicetak dari EKSINTAS | {{ now()->format('d F Y, H:i:s') }}
    </div>

</body>
</html>