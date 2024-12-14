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
            margin-bottom: 40px;
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
            margin-top: 40px;
        }
        .form-row {
            margin: 10px 0;
        }
        .footer-note {
            margin-top: 60%; 
            margin-bottom: 25px;
            color-adjust: grey;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td width="15%" class="text-center">
                <img src="{{ asset('polinema.png') }}" class="logo">
            </td>
            <td width="85%" class="text-center">
                <div style="font-size: 12px; font-weight: bold;">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</div>
                <div style="font-size: 14px; font-weight: bold;">POLITEKNIK NEGERI MALANG</div>
                <div style="font-size: 12px; font-weight: bold;">JURUSAN TEKNOLOGI INFORMASI</div>
                <div style="font-size: 12px;">Jl. Soekarno Hatta No.9 Malang 65141</div>
                <div style="font-size: 12px;">Telp. 0341404424 Fax. 0341404420, http://www.poltek-malang.ac.id</div>
            </td>
            <td width="15%" class="text-center">
                {{-- {{ $qrCode }}  --}}
                <img src="data:image/png;base64,{{ $qrCode }}" alt="QR kode"> 

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
                    <td style="border: none;">Angkatan</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;">{{ $kompen->mahasiswa->periode_tahun }}</td>
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

        <div style="margin-top: 60px;  margin-bottom: 60px" class="ttd" id="ttd">
            <div style="text-align: left;">
                <div style="float: left; width: 50%;">
                    <p>Mengetahui</p>
                    <p>Ka. Program Studi</p>
                    <br><br><br>
                    <p>(Hendra Pradibta, SE., M.Se)</p>
                    <p>NIP. 198305212006041003</p>
                </div>
                <div style="float: right; width: 50%; text-align:right;">
                    <p>Malang, {{ date('d F Y') }}</p>
                    <p>Yang memberikan rekomendasi,</p>
                    <br><br><br>
                    <p>({{ $kompen->kompen->personil->nama }})</p>
                    <p>NIP. {{ $kompen->kompen->personil->nomor_induk }}</p>
                </div>
            </div>
        </div>
        <div style="margin-top:13%" class="footer-note">
            <p>{{ $kompen->kompen->nomor_kompen }}</p>
            <p>NB: Form ini wajib disimpan untuk keperluan bebas tanggungan</p>
        </div>
    </div>
</body>
</html>