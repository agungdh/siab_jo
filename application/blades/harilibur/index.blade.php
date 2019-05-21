@extends('template.template')

@section('title')
Hari Libur
@endsection

@section('nav')
@include('harilibur.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Data Hari Libur</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<a class="btn btn-success btn-sm" href="{{base_url()}}harilibur/tambah">
                  <i class="glyphicon glyphicon-plus"></i> Tambah
                </a><br><br>
              <table class="table table-bordered table-hover datatable" style="width: 100%">
                <thead>
	                <tr>
	                  <th>Tanggal</th>
                      <th>Keterangan</th>
	                  <th>Proses</th>
	                </tr>
                </thead>
                <tbody>
                	@foreach(helper()->tanggalKalender3Tahun() as $item)
                	<tr>
                		<td>{{helper()->tanggalIndo($item->tanggal)}}</td>
                        <td>{{$item->keterangan}}</td>
                		
                		<td>
                        <a class="btn btn-primary btn-sm" href="{{base_url()}}harilibur/ubah/{{$item->id}}">
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

  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-body">
        <div id="kalender"></div>
      </div>
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
	  window.location = "{{base_url()}}harilibur/aksihapus/" + id;
	});
}

$(function() {
  $('#kalender').fullCalendar({
    events: [
        @foreach(helper()->tanggalKalender3Tahun() as $item)
        {
          title  : '{{$item->keterangan}}',
          start  : '{{$item->tanggal}}'
        },
        @endforeach
    ]
  });
});
</script>
@endsection