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
        <h3 align="center">Presensi Peserta Magang</h3>
        <div>
            <li><b>Nama </b>: <span style="margin-left:10px;">{{ $presensiMasuk[0]->peserta->nama }}</span></li>
            <li><b>Asal Sekolah </b>: <span style="margin-left:10px;">{{ $presensiMasuk[0]->peserta->asal_sekolah }}</span></li>
        </div>
        <button class="print-button" onclick="printPage()">Cetak Presensi</button>

        <table align="center" rules="all" border="1px">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Presensi Masuk</th>
                <th>Presensi Pulang</th>
            </tr>
            <tbody>
                @foreach($presensiMasuk as $index => $item)
                <tr>
                    <td align="center">{{ $index + 1 }}</td>
                    <td align="left" style="white-space: nowrap; width: 1%;">
                        <?php setlocale(LC_TIME, 'id_ID'); ?>
                        {{ strftime('%A, %e %B %Y', strtotime($item->created_at)) }}
                    </td>

                    <td align="center">{{ $item->jam_masuk }}</td>
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