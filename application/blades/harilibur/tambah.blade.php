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
			<div class="box-header with-border">
				<h3 class="box-title">Tambah Hari Libur</h3>
			</div>

			<form action="{{base_url()}}harilibur/aksitambah" method="post" role="form">
				@include('harilibur.form')

				<div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="{{base_url()}}harilibur" class="btn btn-info">Batal</a>
				</div>
			</form>
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