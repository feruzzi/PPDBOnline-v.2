<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    
    <title>Bukti Pendaftaran PPDB ONLINE</title>
</head>
<body>
    <div style="width:100%; margin-right:auto; margin-left:auto">
        <div style="text-align:center">
            <h1>Bukti Pendaftaran PPDB ONLINE</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quibusdam placeat saepe optio corporis, iste doloremque nobis similique rem hic reprehenderit dolorum sed soluta corrupti, atque accusantium eum repudiandae qui? Ducimus?</p>         
            <hr style="border:2px solid;color:black;background-color:black">
            <h3 style="font-weight: bold;">Bukti Pendaftaran</h3>
            <h3 style="font-weight: bold;">{{$jalur}}</h3>
        </div>
        <table>
            <thead>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: bold;">ID Pendaftaran</td>
                    <td style="padding: 3px 16px;"> : {{$id_pendaftaran}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">NISN</td>
                    <td style="padding: 3px 16px;"> : {{$nisn}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Nama</td>
                    <td style="padding: 3px 16px;"> : {{$nama_siswa}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Jenis Kelamin</td>
                    <td style="padding: 3px 16px;"> : {{$j_kelamin}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Tempat, Tanggal Lahir</td>
                    <td style="padding: 3px 16px;"> : {{$t_lahir}}, {{$tgl_lahir}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Agama</td>
                    <td style="padding: 3px 16px;"> : {{$agama}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Asal, Nama Sekolah</td>
                    <td style="padding: 3px 16px;"> : {{$asal_sekolah}}, {{$nama_sekolah}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Pilihan 1 dan Pilihan 2</td>
                    <td style="padding: 3px 16px;"> : {{$pilihan_1}} dan {{$pilihan_2}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">No HP</td>
                    <td style="padding: 3px 16px;"> : {{$no_hp}}</td>
                </tr>
            </tbody>
        </table>
        <br>
        <p>Data diatas merupakan bukti pendaftaran PPDB ONLINE {{$jalur}} </p>
    </div>
</body>
</html>