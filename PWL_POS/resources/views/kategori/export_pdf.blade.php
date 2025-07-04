<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 6px 20px 5px 20px;
            line-height: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 4px 3px;
        }

        th {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .font-10 {
            font-size: 10pt;
        }

        .font-11 {
            font-size: 11pt;
        }

        .font-13 {
            font-size: 13pt;
        }

        .border-bottom-header {
            border-bottom: 1px solid;
        }

        .border-all,
        .border-all th,
        .border-all td {
            border: 1px solid;
        }
    </style>
</head>

<body>
    <table class="border-bottom-header">
        <tr>
            <td width="15%" class="text-center">
                <img src="{{ public_path('Polinema.png') }}" style="max-height: 80px; width: auto;">
            </td>
            <td width="85%">
                <span class="text-center d-block font-11 font-bold">
                    KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI
                </span>
                <span class="text-center d-block font-13 font-bold">
                    POLITEKNIK NEGERI MALANG
                </span>
                <span class="text-center d-block font-10">
                    Jl. Soekarno-Hatta No. 9 Malang 65141
                </span>
                <span class="text-center d-block font-10">
                    Telepon (0341) 404424 Pes. 101 105, 0341-404420, Fax. (0341) 404420
                </span>
                <span class="text-center d-block font-10">
                    Laman: www.polinema.ac.id
                </span>
            </td>
        </tr>
    </table>

    <h3 class="text-center">LAPORAN DATA KATEGORI</h3>

    <table class="border-all">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Kode Kategori</th>
                <th>Nama Kategori</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategori as $k)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $k->kategori_kode }}</td>
                    <td>{{ $k->kategori_nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
