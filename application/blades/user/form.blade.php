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
			<select class="form-control select2" name="id_karyawan">
				<option {{$value == '' ? 'selected' : null}} value="">Pilih karyawan</option>
				@foreach($karyawans as $item)
				<option {{$value == $item->id ? 'selected' : null}} value="{{$item->id}}">{{$item->nip}} - {{$item->nama}}</option>
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
			<select class="form-control select2" name="level">
				<option {{$value == '' ? 'selected' : null}} value="">Pilih Level</option>
				<option {{$value == 'a' ? 'selected' : null}} value="a">Admin</option>
				<option {{$value == 'k' ? 'selected' : null}} value="k">Karyawan</option>
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
	@endphp
	<div class="{{$class}}">
		<label for="password" data-toggle="tooltip" title="{{$message}}">Password</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="password" name="password" class="form-control" placeholder="Isi Password" id="password">
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
	@endphp
	<div class="{{$class}}">
		<label for="password_confirmation" data-toggle="tooltip" title="{{$message}}">Ulangi Password</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="password" name="password_confirmation" class="form-control" placeholder="Isi Ulangi Password" id="password_confirmation">
		</div>
	</div>
	
</div>