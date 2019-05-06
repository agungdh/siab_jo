@extends('template.template')

@section('title')
Dashboard
@endsection

@section('nav')
@include('dashboard.nav')
@endsection

@section('content')
<div class="row">

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-green">
        <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Waktu Saat Ini</span>
          <span class="info-box-number" id="valWaktuSaatIni"></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-green">
        <span class="info-box-icon"><i class="fa fa-sign-in"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Berangkat</span>
          <span class="info-box-number">{{$absensisTodayBerangkat ? helper()->tanggalWaktuIndo($absensisTodayBerangkat->waktu) : null}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-orange">
        <span class="info-box-icon"><i class="fa fa-sign-out"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Pulang</span>
          <span class="info-box-number">{{$absensisTodayPulang ? helper()->tanggalWaktuIndo($absensisTodayPulang->waktu) : null}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-window-close"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Absen</span>
          <span class="info-box-number">{{helper()->ribuan(123123)}}X</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Data Absensi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover datatable" style="width: 100%">
                <thead>
	                <tr>
	                  <th>Waktu</th>
                      <th>Tipe</th>
                      <th>Foto</th>
	                </tr>
                </thead>
                <tbody>
                	@foreach($absensis as $item)
                	<tr>
                		<td>{{helper()->tanggalWaktuIndo($item->waktu)}}</td>
                        <td>{{$item->tipe == 'b' ? 'Berangkat' : 'Pulang'}}</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="lihat('{{ helper()->tanggalWaktuIndo($item->waktu) }}', '{{ $item->tipe == 'b' ? 'Berangkat' : 'Pulang' }}', '{{$item->id}}')">
                                <i class="glyphicon glyphicon-trash"></i>
                                Hapus
                            </button>
                        </td>
                	</tr>
                	@endforeach
                </tbody>
              </table>
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
    function lihat(waktu, tipe, id) {
        $("#valWaktu").html(waktu);
        $("#valTipe").html(tipe);
        $("#valGambar").prop('src', '{{base_url()}}uploads/fotoabsen/' + id);

        $("#modalKu").modal();
    }

    var updateWaktu = function () {
        var date = moment(new Date());

        $("#valWaktuSaatIni").html(momentParseToDateTimeIndo(date));
    };

    $(function() {
        updateWaktu();
        setInterval(updateWaktu, 1000);
    });
</script>
@endsection