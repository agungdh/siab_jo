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
			<div class="box-header with-border">
				<h3 class="box-title">Tambah Ijin Absensi</h3>
			</div>

			<form action="{{base_url()}}ijinabsensi/aksitambah" method="post" role="form">
				@include('ijinabsensi.form')

				<div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="{{base_url()}}ijinabsensi" class="btn btn-info">Batal</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection