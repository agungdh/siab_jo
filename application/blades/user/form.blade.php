<div class="box-body">

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('id_karyawan')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('id_karyawan');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['id_karyawan']) {
		$value = ci()->session->flashdata('old')['id_karyawan'];
	} elseif (isset($karyawan) && $karyawan['id_karyawan']) {
		$value = $karyawan['id_karyawan'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="id_karyawan" data-toggle="tooltip" title="{{$message}}">Karyawan</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<select class="form-control select2">
				<option>Pilih karyawan</option>
				@foreach($karyawans as $karyawan)
				<option value="{{$karyawan->id}}">{{$karyawan->nip}} - {{$karyawan->nama}}</option>
				@endforeach
			</select>
		</div>
	</div>
	
	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('level')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('level');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['level']) {
		$value = ci()->session->flashdata('old')['level'];
	} elseif (isset($karyawan) && $karyawan['level']) {
		$value = $karyawan['level'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="level" data-toggle="tooltip" title="{{$message}}">level</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<select class="form-control select2">
				<option>Pilih Level</option>
				<option>Admin</option>
				<option>Karyawan</option>
			</select>
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('password')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('password');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['password']) {
		$value = ci()->session->flashdata('old')['password'];
	} elseif (isset($karyawan) && $karyawan['password']) {
		$value = $karyawan['password'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="password" data-toggle="tooltip" title="{{$message}}">Password</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="password" class="form-control" placeholder="Isi Password" id="password" value="{{$value}}">
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('password_confirmation')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('password_confirmation');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['password_confirmation']) {
		$value = ci()->session->flashdata('old')['password_confirmation'];
	} elseif (isset($karyawan) && $karyawan['password_confirmation']) {
		$value = $karyawan['password_confirmation'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="password_confirmation" data-toggle="tooltip" title="{{$message}}">Ulangi Password</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="password_confirmation" class="form-control" placeholder="Isi Ulangi Password" id="password_confirmation" value="{{$value}}">
		</div>
	</div>
	
</div>