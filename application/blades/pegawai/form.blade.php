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
	} elseif (isset($pegawai) && $pegawai['nip']) {
		$value = $pegawai['nip'];
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
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('id_golongan')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('id_golongan');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['id_golongan']) {
		$value = ci()->session->flashdata('old')['id_golongan'];
	} elseif (isset($pegawai) && $pegawai['id_golongan']) {
		$value = $pegawai['id_golongan'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="id_golongan" data-toggle="tooltip" title="{{$message}}">Golongan</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<select class="form-control select2" name="id_golongan">
				<option {{$value == '' ? 'selected' : null}} value="">Pilih Golongan</option>
				@foreach($golongans as $item)
				<option {{$value == $item->id ? 'selected' : null}} value="{{$item->id}}">{{$item->golongan}}/{{$item->ruang}} {{$item->pangkat}}</option>
				@endforeach
			</select>
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('id_eselon')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('id_eselon');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['id_eselon']) {
		$value = ci()->session->flashdata('old')['id_eselon'];
	} elseif (isset($pegawai) && $pegawai['id_eselon']) {
		$value = $pegawai['id_eselon'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="id_eselon" data-toggle="tooltip" title="{{$message}}">Eselon</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<select class="form-control select2" name="id_eselon">
				<option {{$value == '' ? 'selected' : null}} value="">Pilih Eselon</option>
				@foreach($eselons as $item)
				<option {{$value == $item->id ? 'selected' : null}} value="{{$item->id}}">{{$item->eselon}}</option>
				@endforeach
			</select>
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
	} elseif (isset($pegawai) && $pegawai['nama']) {
		$value = $pegawai['nama'];
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

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('jabatan')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('jabatan');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['jabatan']) {
		$value = ci()->session->flashdata('old')['jabatan'];
	} elseif (isset($pegawai) && $pegawai['jabatan']) {
		$value = $pegawai['jabatan'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="jabatan" data-toggle="tooltip" title="{{$message}}">Jabatan</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="jabatan" class="form-control" placeholder="Isi Jabatan" id="jabatan" value="{{$value}}">
		</div>
	</div>
	
</div>

@section('js')
<script type="text/javascript">
$("#jabatan").easyAutocomplete({
  url: function(phrase) {
    return "{{base_url()}}pegawai/getJabatan/" + phrase;
  },
  getValue: "name",
  requestDelay: 200
});
</script>
@endsection