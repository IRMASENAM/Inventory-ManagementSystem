<!DOCTYPE html>
<html>
<head>
    <title>Laporan Barang Masuk</title>
    <style>
        @page { size: A4 portrait; margin: 15mm; }
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 0; padding: 0; }

        /* Bagian Kop Surat */
        .kop {
            width: 100%;
            display: flex;
            align-items: center;
            background-color: #e0f4ff;
            padding: 10px 15px;
            border-bottom: 3px solid #0dcaf0;
            border-radius: 5px 5px 0 0;
        }
        .kop-logo {
            width: 90px;
            height: auto;
            margin-right: 15px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
        }
        .kop-text h2 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            color: #0d6efd;
        }
        .kop-text p {
            margin: 0;
            font-size: 12px;
            color: #333;
        }

        /* Table */
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; font-size: 12px; text-align: center; }
        th {
            background-color: #0dcaf0;
            color: #fff;
            font-weight: bold;
        }
        tr:nth-child(even) { background-color: #f1faff; }
        tr:nth-child(odd) { background-color: #ffffff; }

        /* Grand Total row highlight */
        .grand-row td {
            background-color: #cfeefd;
            font-weight: bold;
            font-size: 13px;
        }

        /* Footer */
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
            border-top: 1px solid #ccc;
            padding-top: 5px;
        }
        .footer-note { font-style: italic; font-size: 9px; color: #555; }
        .grand-total { color: #0d6efd; }
    </style>
</head>
<body>

    <!-- Kop Surat -->
    <div class="kop">
        <img src="{{ public_path('admin_assets/img/adp.jpg') }}" class="kop-logo">
        <div class="kop-text">
            <h2>PT PLN Indonesia Power UBP Jawa Tengah 2 Adipala</h2>
            <p>Area Sawah/Ladang, Bunton, Kec. Adipala, Kabupaten Cilacap, Jawa Tengah 53271, Indonesia</p>
            <p>Laporan Barang Masuk</p>
        </div>
    </div>

    <!-- Table -->
    <table>
        <thead>
            <tr>
                <th>No Transaksi</th>
                <th>Tanggal Masuk</th>
                <th>Nama Barang</th>
                <th>Jenis</th>
                <th>Supplier</th>
                <th>Jumlah</th>
                <th>Harga Beli</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($LaporanMasuk as $item)
                @php $grandTotal += $item->total_harga; @endphp
                <tr>
                    <td>{{ $item->no_transaksi }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tgl_masuk)->format('d-m-Y') }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->nama_jenis }}</td>
                    <td>{{ $item->nama_supplier }}</td>
                    <td>{{ $item->jumlah_masuk }}</td>
                    <td>Rp {{ number_format($item->harga_beli,0,',','.') }}</td>
                    <td>Rp {{ number_format($item->total_harga,0,',','.') }}</td>
                </tr>
            @endforeach
            <!-- Grand Total Row -->
            <tr class="grand-row">
                <td colspan="7">Grand Total</td>
                <td>Rp {{ number_format($grandTotal,0,',','.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        Dicetak tanggal: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}<br>
        <span class="footer-note">Dokumen resmi PT PLN Indonesia Power UBP Jawa Tengah 2 Adipala</span>
    </div>

</body>
</html>
