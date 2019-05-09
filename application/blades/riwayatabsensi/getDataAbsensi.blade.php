@php
$tanggal = date('YmdHisu');
@endphp

<table class="table table-bordered table-hover datatable" style="width: 100%" id="tabel__{{$tanggal}}">
    <thead>
        <tr>
          <th>Karyawan</th>
          <th>Waktu</th>
          <th>Tipe</th>
          <th>Proses</th>
        </tr>
    </thead>
    <tbody>
    	@foreach($datas as $item)
    	<tr>
            <td>{{$item->karyawan->nip}} - {{$item->karyawan->nama}}</td>
            <td>{{helper()->tanggalWaktuIndo($item->waktu)}}</td>
            <td>{{$item->tipe == 'b' ? 'Berangkat' : 'Pulang'}}</td>
      		  <td>
                <button type="button" class="btn btn-primary btn-sm" onclick="lihat('{{ helper()->tanggalWaktuIndo($item->waktu) }}', '{{ $item->tipe == 'b' ? 'Berangkat' : 'Pulang' }}', '{{$item->id}}', '{{$item->lat}}', '{{$item->lng}}', '{{$item->karyawan->nip}} - {{$item->karyawan->nama}}', '{{$item->karyawan->id}}')">
                    <i class="glyphicon glyphicon-eye-open"></i>
                    Detail
                </button>
            </td>
    	</tr>
    	@endforeach
    </tbody>
</table>

<script type="text/javascript">
    $('#tabel__{{$tanggal}}').DataTable({
      responsive: false,
      "scrollX": true
    });
</script>