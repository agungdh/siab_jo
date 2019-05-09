<div class="box-body">

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('nip')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('nip');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['nip']) {
		$value = ci()->session->flashdata('old')['nip'];
	} elseif (isset($karyawan) && $karyawan['nip']) {
		$value = $karyawan['nip'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="nip" data-toggle="tooltip" title="{{$message}}">NIP</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="nip" class="form-control" placeholder="Isi NIP" id="nip" value="{{$value}}">
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('nama')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('nama');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['nama']) {
		$value = ci()->session->flashdata('old')['nama'];
	} elseif (isset($karyawan) && $karyawan['nama']) {
		$value = $karyawan['nama'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="nama" data-toggle="tooltip" title="{{$message}}">Nama</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="nama" class="form-control" placeholder="Isi Nama" id="nama" value="{{$value}}">
		</div>
	</div>
	
</div>