<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data POD - PLN Indonesia Power UBP Jateng 2 Adipala</title>
    <style>
        /* ==========================
           PENGATURAN HALAMAN
        =========================== */
        @page {
            size: A4 portrait; /* ubah ke 'A4 landscape' jika ingin horizontal */
            margin: 95px 35px 60px 35px;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 11.5px;
            color: #222;
            margin: 0;
            padding: 0;
            line-height: 1.5;
        }

        /* ==========================
           HEADER (KOP SURAT)
        =========================== */
        header {
            position: fixed;
            top: -80px;
            left: 0;
            right: 0;
            height: 90px;
            border-bottom: 3px solid #007bff;
            background-color: #f5f9ff;
        }

        header table {
            width: 100%;
            border-collapse: collapse;
        }

        header img {
            width: 80px;
            height: auto;
            margin-left: 10px;
        }

        header h1 {
            margin: 0;
            font-size: 18px;
            color: #0056b3;
            font-weight: bold;
            text-transform: uppercase;
        }

        header h2 {
            margin: 3px 0 2px 0;
            font-size: 13px;
            color: #333;
            font-weight: normal;
        }

        header p {
            font-size: 10px;
            color: #555;
            margin: 0;
        }

        /* ==========================
           FOOTER
        =========================== */
        footer {
            position: fixed;
            bottom: -45px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #555;
            border-top: 1px solid #ccc;
            padding-top: 4px;
        }

        /* ==========================
           KONTEN UTAMA
        =========================== */
        main {
            margin-top: 15px;
        }

        h3 {
            text-align: center;
            color: #003366;
            font-size: 15px;
            text-transform: uppercase;
            margin: 0 0 15px 0;
            padding-bottom: 5px;
            border-bottom: 2px solid #007bff;
            display: inline-block;
        }

        /* ==========================
           TABEL DATA
        =========================== */
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            border: 1px solid #000;
        }

        table.data th,
        table.data td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: center;
            vertical-align: middle;
            font-size: 11px;
        }

        table.data th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        table.data tr:nth-child(even) td {
            background-color: #f8fbff;
        }

        table.data tr:nth-child(odd) td {
            background-color: #ffffff;
        }

        table.data tr:hover td {
            background-color: #e6f1ff;
        }

        .no-data {
            text-align: center;
            font-style: italic;
            color: #999;
            padding: 10px 0;
        }

    </style>
</head>
<body>

    <!-- ===== HEADER ===== -->
    <header>
        <table>
            <tr>
                <td style="width: 13%; text-align: center;">
                    <img src="{{ public_path('admin_assets/img/adp.jpg') }}" alt="Logo PLN Power">
                </td>
                <td style="width: 87%; padding-left: 8px;">
                    <h1>PT PLN Indonesia Power</h1>
                    <h2>Unit Bisnis Pembangkitan Jateng 2 Adipala</h2>
                    <p>Jl. Raya Adipala – Karangbolong No.1, Adipala, Cilacap, Jawa Tengah 53271</p>
                </td>
            </tr>
        </table>
    </header>

    <!-- ===== FOOTER ===== -->
    <footer>
        EKSIS {{ date('Y') }} © Sistem EKSINTAS | PT PLN Indonesia Power UBP Jateng 2 Adipala | All rights reserved.
    </footer>

    <!-- ===== MAIN CONTENT ===== -->
    <main>
        <div style="text-align:center; margin-bottom:10px;">
            <h3>Data Plan of Development (POD)</h3>
        </div>

        <table class="data">
            <thead>
                <tr>
                    <th style="width: 4%;">No</th>
                    <th style="width: 13%;">Nomor POD</th>
                    <th style="width: 10%;">Tanggal</th>
                    <th style="width: 13%;">Jenis POD</th>
                    <th style="width: 17%;">Kategori</th>
                    <th style="width: 12%;">Tipe POD</th>
                    <th style="width: 14%;">Departemen</th>
                    <th style="width: 17%;">Dibuat Oleh</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pods as $i => $pod)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $pod->nomor_pod }}</td>
                        <td>{{ \Carbon\Carbon::parse($pod->tanggal)->format('d M Y') }}</td>
                        <td>{{ $pod->jenis_pod }}</td>
                        <td>{{ $pod->kategori_perawatan }}</td>
                        <td>{{ $pod->tipe_pod }}</td>
                        <td>{{ $pod->departemen }}</td>
                        <td>{{ $pod->dibuat_oleh }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="no-data">Tidak ada data POD yang tersimpan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>

</body>
</html>
