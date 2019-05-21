<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<table border="1">
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
			@php
			$terlambat = DB()
							->table('absensi')
							->where('tipe', 'b')
							->whereNull('invalidated')
							->whereRaw('TIME(waktu) > ?
										AND MONTH(waktu) = ?
										AND YEAR(waktu) = ?',
										[
											getenv('WAKTU_BERANGKAT'),
											$bulan,
											$tahun,
										])
							->get();
			$totalTerlambat = count($terlambat);
			
			$durasiTerlambat = 0;
			foreach ($terlambat as $itemTerlambat) {
				$tempTimeDiff = 0;
				
			}

			dd(
				compact(
					'terlambat',
					'totalTerlambat',
					'durasiTerlambat',
				)
			);
			@endphp
			<td>{{$i}}</td>
			<td>{{$i}}</td>
			<td>{{$i}}</td>
			<td>{{$i}}</td>
			<td>{{$i}}</td>
		</tr>
		@endforeach
	</tbody>
</table>

</body>
</html>