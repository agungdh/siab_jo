@php
$tanggal = date('YmdHisu');
@endphp

<table class="table table-bordered table-hover datatable" style="width: 100%" id="tabel__{{$tanggal}}">
    <thead>
        <tr>
          <th>Pegawai</th>
          <th>Waktu</th>
          <th>Tipe</th>
          <th>Proses</th>
        </tr>
    </thead>
    <tbody>
    	@foreach($datas as $item)
    	<tr>
            <td>{{$item->pegawai->nip}} - {{$item->pegawai->nama}}</td>
            <td>{{helper()->tanggalWaktuIndo($item->waktu)}}</td>
            <td>{{$item->tipe == 'b' ? 'Berangkat' : 'Pulang'}}</td>
      		  <td>
                <button type="button" class="btn btn-primary btn-sm" onclick="lihat('{{ helper()->tanggalWaktuIndo($item->waktu) }}', '{{ $item->tipe == 'b' ? 'Berangkat' : 'Pulang' }}', '{{$item->id}}', '{{$item->lat}}', '{{$item->lng}}', '{{$item->pegawai->nip}} - {{$item->pegawai->nama}}', '{{$item->pegawai->id}}', {{$item->invalidated ? 0 : 1}})">
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