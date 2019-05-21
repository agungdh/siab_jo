<div class="box-body">

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('id_pegawai')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('id_pegawai');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['id_pegawai']) {
		$value = ci()->session->flashdata('old')['id_pegawai'];
	} elseif (isset($user) && $user['id_pegawai']) {
		$value = $user['id_pegawai'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="id_pegawai" data-toggle="tooltip" title="{{$message}}">Pegawai</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<select class="form-control select2" name="id_pegawai">
				<option {{$value == '' ? 'selected' : null}} value="">Pilih Pegawai</option>
				@foreach($pegawais as $item)
				<option {{$value == $item->id ? 'selected' : null}} value="{{$item->id}}">{{$item->nip}} - {{$item->nama}}</option>
				@endforeach
			</select>
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('tanggal')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('tanggal');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['tanggal']) {
		$value = ci()->session->flashdata('old')['tanggal'];
	} elseif (isset($hariLibur) && $hariLibur['tanggal']) {
		$value = $hariLibur['tanggal'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="tanggal" data-toggle="tooltip" title="{{$message}}">Tanggal</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="tanggal" class="form-control datepicker" placeholder="Isi Tanggal" id="tanggal" value="{{$value}}">
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('tipe')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('tipe');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['tipe']) {
		$value = ci()->session->flashdata('old')['tipe'];
	} elseif (isset($user) && $user['tipe']) {
		$value = $user['tipe'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="tipe" data-toggle="tooltip" title="{{$message}}">Tipe</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<select class="form-control select2" name="tipe">
				<option {{$value == '' ? 'selected' : null}} value="">Pilih Tipe</option>
				<option {{$value == 's' ? 'selected' : null}} value="s">Sakit</option>
				<option {{$value == 'i' ? 'selected' : null}} value="i">Ijin</option>
				<option {{$value == 'c' ? 'selected' : null}} value="c">Cuti</option>
			</select>
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('keterangan')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('keterangan');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['keterangan']) {
		$value = ci()->session->flashdata('old')['keterangan'];
	} elseif (isset($hariLibur) && $hariLibur['keterangan']) {
		$value = $hariLibur['keterangan'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="keterangan" data-toggle="tooltip" title="{{$message}}">Keterangan</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="keterangan" class="form-control" placeholder="Isi Keterangan" id="keterangan" value="{{$value}}">
		</div>
	</div>
	
</div>