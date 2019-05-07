@extends('template.template')

@section('title')
Riwayat Absensi
@endsection

@section('nav')
@include('dashboard.nav')
@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">

      <div class="box box-body">

        <div class="col-md-4">
          <div class="form-group has-feedback">
            <label for="id_karyawan">Karyawan</label>
            <select class="form-control select2" name="id_karyawan" id="id_karyawan">
              <option value="0">Semua Karyawan</option>
              @foreach($karyawans as $item)
              <option value="{{$item->id}}">{{$item->nip}} - {{$item->nama}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group has-feedback">
            <label for="tanggal">Tanggal</label>
            <input autocomplete="off" type="text" name="tanggal" id="tanggal" class="form-control datepicker">
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group has-feedback">
            <label for="sampai">Sampai</label>
            <input autocomplete="off" type="text" name="sampai" id="sampai" class="form-control datepicker">
          </div>
        </div>

      </div>

      <div class="box-footer">
        <button type="button" class="btn btn-success" id="filter">Filter</button>
        <button type="button" class="btn btn-primary" id="reset">Reset</button>
      </div>
        
    </div>
  </div>
</div>

<div class="row">

	<div class="col-md-12">
		<div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Data Absensi</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div id="iniTabel">
        </div>
      </div>
      <!-- /.box-body -->
    </div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalKu" role="dialog">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Data Absensi</h4>
    </div>
    <div class="modal-body">
    <table class="table table-responsive">
          <tr>
            <td>Waktu</td>
            <td>: <span id="valWaktu"></span></td>
          </tr>
          <tr>
            <td>Tipe</td>
            <td>: <span id="valTipe"></span></td>
          </tr>
    </table>
    <img id="valGambar" class="img-responsive" alt="Gambar">
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $("#filter").click(function() {
    prosesFilter();
  });

  $("#reset").click(function() {
    $("#id_karyawan").val('0');
    $("#id_karyawan").select2('destroy');
    $("#id_karyawan").select2();
    $("#tanggal").val('')
    $("#sampai").val('')
  });

  function prosesFilter()
  {
    var id_karyawan = $("#id_karyawan").val();
    var tanggal = $("#tanggal").val() == '' ? 0 : $("#tanggal").val();
    var sampai = $("#sampai").val() == '' ? 0 : $("#sampai").val();

    $.ajax({
      type: "GET",
      url: `{{base_url()}}riwayatabsensi/getDataAbsensi/${id_karyawan}/${tanggal}/${sampai}`,
      data: {
        
      },
      success: function(data, textStatus, xhr ) {
        if (!jQuery.isEmptyObject(data)) {
          $("#iniTabel").html(data);
        } else {
          console.log('empty data ...');
        }
      },
      error: function(xhr, textStatus, errorThrown) {
        console.table([
          {
            kolom: 'xhr',
            data: xhr
          },
          {
            kolom: 'textStatus',
            data: textStatus
          },
          {
            kolom: 'errorThrown',
            data: errorThrown
          }
        ]);
      }
    });

  }

  function lihat(waktu, tipe, id) {
      $("#valWaktu").html(waktu);
      $("#valTipe").html(tipe);
      $("#valGambar").prop('src', '{{base_url()}}uploads/fotoabsen/' + id);

      $("#modalKu").modal();
  }

  $(function() {
    prosesFilter();
  });
</script>
@endsection