@extends('template.template')

@section('title')
Ijin Absensi
@endsection

@section('nav')
@include('ijinabsensi.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Data Ijin Absensi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<a class="btn btn-success btn-sm" href="{{base_url()}}ijinabsensi/tambah">
                  <i class="glyphicon glyphicon-plus"></i> Tambah
                </a><br><br>
              <table class="table table-bordered table-hover datatable" style="width: 100%">
                <thead>
	                <tr>
	                  <th>Pegawai</th>
                      <th>Tanggal</th>
                      <th>Tipe</th>
                      <th>Keterangan</th>
	                  <th>Proses</th>
	                </tr>
                </thead>
                <tbody>
                	@foreach($ijinAbsensis as $item)
                	<tr>
                        <td>{{$item->pegawai->nip}} - {{$item->pegawai->nama}}</td>
                        <td>{{helper()->tanggalIndo($item->tanggal)}}</td>
                        @switch($item->tipe)
                            @case('s')
                                <td>Sakit</td>
                                @break
                            @case('i')
                                <td>Ijin</td>
                                @break
                            @case('c')
                                <td>Cuti</td>
                                @break
                            @default
                                <td>ERROR !!!</td>
                                @break
                        @endswitch
                        <td>{{$item->keterangan}}</td>
                		
                		<td>
	              		   <button type="button" class="btn btn-danger btn-sm" onclick="hapus('{{ $item->id }}')"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
                		</td>
                	</tr>
                	@endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
function hapus(id) {
	swal({
	  title: "Yakin Hapus ???",
	  text: "Data yang sudah dihapus tidak dapat dikembalikan lagi !!!",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Hapus",
	}, function(){
	  window.location = "{{base_url()}}ijinabsensi/aksihapus/" + id;
	});
}
</script>
@endsection