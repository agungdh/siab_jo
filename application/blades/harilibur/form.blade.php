<div class="box-body">

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