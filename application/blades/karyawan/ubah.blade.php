@extends('template.template')

@section('title')
Karyawan
@endsection

@section('nav')
@include('karyawan.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Ubah Karyawan</h3>
			</div>

			<form action="{{base_url()}}karyawan/aksiubah/{{$karyawan->id}}" method="post" role="form">
				@include('karyawan.form')

				<div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="{{base_url()}}karyawan" class="btn btn-info">Batal</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection