<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presensi Report</title>
    <style>
        #customers {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        #customers td, #customers th {
          border: 1px solid #ddd;
          padding: 8px;
        }
        
        #customers tr:nth-child(even){background-color: #f2f2f2;}
        
        #customers tr:hover {background-color: #ddd;}
        
        #customers th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #04AA6D;
          color: white;
        }
    </style>
</head>
<body>
 
    <center>
        <h1>Laporan Presensi Rapat {{ $attendances[0]->metting->title }}</h1>
    </center>

    <table id="customers">
        <tr>
            <th>No</th>
            <th>Nama Pengurus</th>
            <th>Email Pengurus</th>
            <th>Kelas</th>
            <th>Konselor</th>
            <th>Presensi</th>
        </tr>
        @forelse ($attendances as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->user->email }}</td>
                <td>{{ $item->user->kelas }}</td>
                <td>{{ $item->user->konselor }}</td>
                <td class="{{ $item->status == 'Hadir' ? 'bg-primary text-white' : ($item->status == 'Tidak Hadir' ? 'bg-danger text-white' : '') }}">
                    {{ $item->status }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Belum Ada Yang Hadir</td>
            </tr>
        @endforelse
    </table>
</body>
</html>

