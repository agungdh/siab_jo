@extends('template.template')

@section('title')
User
@endsection

@section('nav')
@include('user.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Data User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<a class="btn btn-success btn-sm" href="{{base_url()}}user/tambah">
                  <i class="glyphicon glyphicon-plus"></i> Tambah
                </a><br><br>
              <table class="table table-bordered table-hover datatable" style="width: 100%">
                <thead>
	                <tr>
	                  <th>NIP</th>
                      <th>Nama</th>
                      <th>Level</th>
                      <th>Proses</th>
	                </tr>
                </thead>
                <tbody>
                	@foreach($users as $item)
                	<tr>
                        <td>{{$item->pegawai->nip}}</td>
                        <td>{{$item->pegawai->nama}}</td>
                        <td>{{$item->level == 'a' ? 'Admin' : 'Pegawai'}}</td>
                		
                		<td>
                        <a class="btn btn-primary btn-sm" href="{{base_url()}}user/ubah/{{$item->id}}">
    	                  <i class="glyphicon glyphicon-pencil"></i> Ubah
    	                </a>

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
	  window.location = "{{base_url()}}user/aksihapus/" + id;
	});
}
</script>
@endsection