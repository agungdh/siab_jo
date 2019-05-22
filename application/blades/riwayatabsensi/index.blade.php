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

        <div class="col-md-6">
          <div class="form-group has-feedback">
            <label for="id_pegawai">Pegawai</label>
            <select class="form-control select2" name="id_pegawai" id="id_pegawai">
              @if($userData->level == 'a')
              <option value="0">Semua Pegawai</option>
              @foreach($pegawais as $item)
              <option value="{{$item->id}}">{{$item->nip}} - {{$item->nama}}</option>
              @endforeach
              @else
              <option value="{{$userData->pegawai->id}}">{{$userData->pegawai->nip}} - {{$userData->pegawai->nama}}</option>
              @endif
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group has-feedback">
            <label for="validity">Validity</label>
            <select class="form-control select2" name="validity" id="validity">
              <option value="1">Valid</option>
              <option value="0">Invalid</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group has-feedback">
            <label for="tanggal">Tanggal</label>
            <input autocomplete="off" type="text" name="tanggal" id="tanggal" class="form-control datepicker">
          </div>
        </div>

        <div class="col-md-6">
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
    
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <table>
              <tr>
                <td>Pegawai</td>
                <td>: <span id="valPegawai"></span></td>
              </tr>
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

      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div id="map" style="height: 400px; width: 100%;" class="gmap"></div>
      </div>

    </div>
    <div class="modal-footer">
      @if(getUserData()->level == 'a')
      <button id="btnHapus" type="button" class="btn btn-danger" onclick="hapus()">Hapus</button>
      <button id="btnValidate" type="button" class="btn btn-success" onclick="validate()">Validate</button>
      <button id="btnInvalidate" type="button" class="btn btn-warning" onclick="invalidate()">Invalidate</button>
      @endif
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
    @if($userData->level == 'a')
    $("#id_pegawai").val('0');
    $("#id_pegawai").select2('destroy');
    $("#id_pegawai").select2();
    @endif

    $("#tanggal").val('')
    $("#sampai").val('')
  });

  function prosesFilter()
  {
    var id_pegawai = $("#id_pegawai").val();
    var tanggal = $("#tanggal").val() == '' ? 0 : $("#tanggal").val();
    var sampai = $("#sampai").val() == '' ? 0 : $("#sampai").val();
    var validity = $("#validity").val();

    $.ajax({
      type: "GET",
      url: `{{base_url()}}riwayatabsensi/getDataAbsensi/${id_pegawai}/${tanggal}/${sampai}/${validity}`,
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

  function lihat(waktu, tipe, id, lat, lng, pegawai, id_pegawai, validity) {
        state.data.id_pegawai_show = id_pegawai;
        state.data.id_absensi = id;
        state.data.validity = validity;

        if (validity == '1') {
          $("#btnHapus").hide();
          $("#btnValidate").hide();
          $("#btnInvalidate").show();
        } else if (validity == '0') {
          $("#btnHapus").show();
          $("#btnValidate").show();
          $("#btnInvalidate").hide();
        }

        state.data.latlng = {
            lat: parseFloat(lat),
            lng: parseFloat(lng),
        };
        initMap();

        $("#valPegawai").html(pegawai);
        $("#valWaktu").html(waktu);
        $("#valTipe").html(tipe);
        $("#valGambar").prop('src', '{{base_url()}}uploads/fotoabsen/' + id);

        $("#modalKu").modal();
    }

  $(function() {
    prosesFilter();
  });

  function initMap() {    
      state.data.map = new google.maps.Map(document.getElementById('map'), {
        zoom: 19,
        center: state.data.latlng
      });

      state.data.marker = new google.maps.Marker({
        position: state.data.latlng,
        map: state.data.map
      });

      state.data.polygon = new google.maps.Polygon({
        paths: state.data.polygonCoords,
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 3,
        fillColor: '#FF0000',
        fillOpacity: 0.35
      });
      state.data.polygon.setMap(state.data.map);
    }

    function hapus(id) {
      swal({
        title: "Yakin Hapus ???",
        text: "Data yang sudah dihapus tidak dapat dikembalikan lagi !!!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Hapus",
      }, function(){
        window.location = "{{base_url()}}riwayatabsensi/aksihapus/" + state.data.id_absensi;
      });
    }

    function validate(id) {
      swal({
        title: "Yakin Validate ???",
        text: "Data akan divalidate !!!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#008D4C",
        confirmButtonText: "Validate",
      }, function(){
        window.location = "{{base_url()}}riwayatabsensi/validate/" + state.data.id_absensi;
      });
    }

    function invalidate(id) {
      swal({
        title: "Yakin Invalidate ???",
        text: "Data akan diinvalidate !!!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#E08E0B",
        confirmButtonText: "Invalidate",
      }, function(){
        window.location = "{{base_url()}}riwayatabsensi/invalidate/" + state.data.id_absensi;
      });
    }
</script>
@endsection