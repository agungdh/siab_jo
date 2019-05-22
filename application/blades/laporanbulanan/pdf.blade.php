<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h3 style="text-align: center;">Absensi Pegawai BAPPEDA Pringsewu</h3>
<h3 style="text-align: center;">{{helper()->tanggalIndoStringBulanTahun("{$bulan}-{$tahun}")}}</h3>
<table border="1" width="100%">
	<thead>
		<tr>
			<th>NO</th>
			<th>NIP</th>
			<th>NAMA</th>
			<th>GOLONGAN/PANGKAT</th>
			<th>ESELON</th>
			<th>JABATAN</th>
			<th>TERLAMBAT</th>
			<th>PULANG CEPAT</th>
			<th>SAKIT</th>
			<th>IJIN</th>
			<th>CUTI</th>
			<th>TIDAK ABSEN</th>
		</tr>
	</thead>
	<tbody>
		@php
		$i = 1;
		@endphp
		@foreach($pegawais as $item)
		<tr>
			<td>{{$i++}}</td>
			<td>{{$item->nip}}</td>
			<td>{{$item->nama}}</td>
			<td>{{$item->golongan->golongan}}/{{$item->golongan->ruang}} {{$item->golongan->pangkat}}</td>
            <td>{{$item->eselon ? $item->eselon->eselon : '-'}}</td>
			<td>{{$item->jabatan}}</td>
			<td>{{helper()->tidakSesuaiWaktu($item->id, $bulan, $tahun) ?: '-'}}</td>
			<td>{{helper()->tidakSesuaiWaktu($item->id, $bulan, $tahun, false) ?: '-'}}</td>
			<td>{{helper()->tidakMasuk($item->id, $bulan, $tahun, 's') ?: '-'}}</td>
			<td>{{helper()->tidakMasuk($item->id, $bulan, $tahun, 'i') ?: '-'}}</td>
			<td>{{helper()->tidakMasuk($item->id, $bulan, $tahun, 'c') ?: '-'}}</td>
			<td>{{helper()->jumlahGakAbsen($item->id, $bulan, $tahun)}}</td>
		</tr>
		@endforeach
	</tbody>
</table>

</body>
</html>