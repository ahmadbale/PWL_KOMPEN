<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 6px 20px 5px 20px;
            line-height: 1.5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td, th {
            padding: 4px 3px;
            border: 1px solid black;
        }
        .text-center {
            text-align: center;
        }
        .header-table {
            border: none;
            margin-bottom: 20px;
        }
        .header-table td {
            border: none;
            vertical-align: middle;
        }
        .logo {
            width: 100px;
            height: auto;
        }
        .form-content {
            margin-top: 20px;
        }
        .form-row {
            margin: 10px 0;
        }
        .signature-section {
            margin-top: 30px;
            text-align: right;
        }
        .footer-note {
            margin-top: 20px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td width="15%" class="text-center">
                <img src="{{ public_path('assets/polinema-bw.png') }}" class="logo">
            </td>
            <td width="85%" class="text-center">
                <div style="font-size: 12px; font-weight: bold;">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</div>
                <div style="font-size: 14px; font-weight: bold;">POLITEKNIK NEGERI MALANG</div>
                <div style="font-size: 12px; font-weight: bold;">PROGRAM STUDI TEKNIK INFORMATIKA</div>
                <div style="font-size: 12px;">Jl. Soekarno Hatta No.9 Malang 65141</div>
                <div style="font-size: 12px;">Telp. 0341404424 Fax. 0341404420, http://www.poltek-malang.ac.id</div>
            </td>
        </tr>
    </table>

    <div style="border-bottom: 2px solid black; margin: 10px 0;"></div>

    <h3 class="text-center">BERITA ACARA KOMPENSASI PRESENSI</h3>

    <div class="form-content">
        <div class="form-row">
            <table style="border: none;">
                <tr>
                    <td style="border: none; width: 200px;">Nama Pengajar</td>
                    <td style="border: none; width: 10px;">:</td>
                    <td style="border: none;">{{ $kompen->kompen->personil->nama }}</td>
                </tr>
                <tr>
                    <td style="border: none;">NIP</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;">{{ $kompen->kompen->personil->nomor_induk }}</td>
                </tr>
            </table>
        </div>

        <div style="margin-top: 20px;">
            <p>Memberikan rekomendasi kompensasi kepada :</p>
            <table style="border: none;">
                <tr>
                    <td style="border: none; width: 200px;">Nama Mahasiswa</td>
                    <td style="border: none; width: 10px;">:</td>
                    <td style="border: none;">{{ $kompen->mahasiswa->nama }}</td>
                </tr>
                <tr>
                    <td style="border: none;">NIM</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;">{{ $kompen->mahasiswa->nomor_induk }}</td>
                </tr>
                <tr>
                    <td style="border: none;">Kelas</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;">{{ $kompen->kelas }}</td>
                </tr>
                <tr>
                    <td style="border: none;">Semester</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;">{{ $kompen->mahasiswa->periode }}</td>
                </tr>
                <tr>
                    <td style="border: none;">Pekerjaan</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;">{{ $kompen->kompen->nama }}</td>
                </tr>
                <tr>
                    <td style="border: none;">Jumlah Jam</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;">{{ $kompen->kompen->jam_kompen }}</td>
                </tr>
            </table>
        </div>

        <div class="signature-section">
            <p>Malang, {{ date('d F Y') }}</p>
            <p>Yang memberikan rekomendasi,</p>
            <br><br><br>
            <p>({{ $kompen->kompen->personil->nama }})</p>
            <p>NIP. {{ $kompen->kompen->personil->nomor_induk }}</p>
        </div>

        <div class="footer-note">
            <p>{{ $kompen->kompen->nomor_kompen }}</p>
            <p>NB: Form ini wajib disimpan untuk keperluan bebas tanggungan</p>
        </div>
    </div>
</body>
</html>