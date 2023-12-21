<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Peserta Magang</title>
    <style>
        h3 {
            margin-bottom: 50px;
        }

        li {
            display: table-row;
        }

        b {
            display: table-cell;
            padding-right: 1em;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            padding: 5px;
            /* Adjust the padding value as needed */
        }

        .print-button {
            background-color: transparent;
            border: 2px solid #007bff;
            /* Warna biru: #007bff */
            color: #007bff;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 20px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .print-button:hover {
            background-color: #007bff;
            color: #fff;
        }

        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="form-group">
        <h3 align="center">Progress Peserta Magang</h3>
        <div>
            <li><b>Nama </b>: <span style="margin-left:10px;">{{ $progress[0]->pekerjaan->peserta->nama }}</span></li>
            <li><b>Asal Sekolah </b>: <span style="margin-left:10px;">{{ $progress[0]->pekerjaan->peserta->asal_sekolah }}</span></li>
        </div>
        <button class="print-button" onclick="printPage()">Cetak Progress</button>

        <table align="center" rules="all" border="1px">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Judul</th>
                <th>Catatan</th>
                <th>Dokumentasi</th>
                <th>TTD</th>
            </tr>
            <tbody>
                @foreach($progress as $index => $item)
                <tr>
                    <td align="center">{{ $index + 1 }}</td>
                    <td align="left">
                        {{ ($item->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                    </td>
                    <td align="left">{{ $item->pekerjaan->judul }}</td>
                    <td align="left">{{ $item->catatan }}</td>
                    <td align="left">
                        @if ($item->foto_dokumentasi)
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('storage/images/' . $item->foto_dokumentasi) }}" alt="Gambar tidak tersedia" width="60" style="display: block; margin: 0 auto;">
                        @else
                        Gambar tidak tersedia
                        @endif
                    </td>
                    <td align="center">
                        @if ($item->peserta && $item->peserta->ttd)
                        <img src="{{ Storage::url('public/images/' . $item->peserta->ttd) }}" alt="TTD" width="70" style="display: block; margin: 0 auto;"><br>
                        {{ $item->peserta->nama }}
                        @else
                            @if ($item->pembimbing && $item->pembimbing->ttd)
                            <img src="{{ Storage::url('public/images/' . $item->pembimbing->ttd) }}" alt="TTD Pembimbing" width="70" style="display: block; margin: 0 auto;"><br>
                            {{ $item->pembimbing->nama }}
                        @else
                        Tanda tangan tidak tersedia
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function printPage() {
            window.print();
        }
    </script>

</body>

</html>