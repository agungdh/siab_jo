@extends('template.template')

@section('title')
Dashboard
@endsection

@section('nav')
@include('dashboard.nav')
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Grafik Tidak Absen</h3>
      </div>
      <div class="box-body">
        <div class="embed-responsive embed-responsive-16by9">
          <canvas class="embed-responsive-item" id="chartIjinAbsensi"></canvas>
        </div>
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
              <table class="table table-bordered table-hover datatable" style="width: 100%">
                <thead>
	                <tr>
	                  <th>Waktu</th>
                      <th>Tipe</th>
                      <th>Proses</th>
	                </tr>
                </thead>
                <tbody>
                	@foreach($absensis as $item)
                	<tr>
                		<td>{{helper()->tanggalWaktuIndo($item->waktu)}}</td>
                        <td>{{$item->tipe == 'b' ? 'Berangkat' : 'Pulang'}}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" onclick="lihat('{{ helper()->tanggalWaktuIndo($item->waktu) }}', '{{ $item->tipe == 'b' ? 'Berangkat' : 'Pulang' }}', '{{$item->id}}', '{{$item->lat}}', '{{$item->lng}}', `{{$pegawai->nip}} - {{$pegawai->nama}}`)">
                                <i class="glyphicon glyphicon-eye-open"></i>
                                Detail
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
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
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

    function lihat(waktu, tipe, id, lat, lng, pegawai) {
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

    var updateWaktu = function () {
        var date = moment(new Date());

        $("#valWaktuSaatIni").html(momentParseToDateTimeIndo(date));
    };

    $(function() {
        updateWaktu();
        setInterval(updateWaktu, 1000);
    });
</script>

<script type="text/javascript">
var data = {
      labels: [
      
      @php
      for ($i=0; $i <= 11; $i++) {
            $array[] = helper()->tanggalIndoStringBulanTahun(date("m-Y", strtotime("-" . $i . " months")));
      }
      foreach (array_reverse($array) as $item) {
            echo '"'.$item.'",';
       }
       unset($array);
      @endphp
      ],
      datasets: [
            {
                  label: "Sakit",
                  fillColor: "rgba(220,220,220,0.2)",
                  strokeColor: "rgba(220,220,220,1)",
                  pointColor: "rgba(220,220,220,1)",
                  pointStrokeColor: "#fff",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(220,220,220,1)",
                  data: [
                  @php
                  for ($i=0; $i <= 11; $i++) {
                        $bulan = explode('-', date("m-Y", strtotime("-" . $i . " months")))[0];
                        $tahun = explode('-', date("m-Y", strtotime("-" . $i . " months")))[1];
                        $array[] = helper()->tidakMasuk(getUserData()->pegawai->id, $bulan, $tahun, 's');            
                  }
                  foreach (array_reverse($array) as $item) {
                        echo '"'.$item.'",';
                   }
                   unset($array);
                  @endphp
                  ]
            },
            {
                  label: "Ijin",
                  fillColor: "rgba(151,187,205,0.2)",
                  strokeColor: "rgba(151,187,205,1)",
                  pointColor: "rgba(151,187,205,1)",
                  pointStrokeColor: "#fff",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(151,187,205,1)",
                  data: [
                  @php
                  for ($i=0; $i <= 11; $i++) {
                        $bulan = explode('-', date("m-Y", strtotime("-" . $i . " months")))[0];
                        $tahun = explode('-', date("m-Y", strtotime("-" . $i . " months")))[1];
                        $array[] = helper()->tidakMasuk(getUserData()->pegawai->id, $bulan, $tahun, 'i');
                  }
                  foreach (array_reverse($array) as $item) {
                        echo '"'.$item.'",';
                   }
                   unset($array);
                  @endphp
                  ]
            },
            {
                  label: "Cuti",
                  fillColor: "rgba(100,110,120,0.2)",
                  strokeColor: "rgba(100,110,120,1)",
                  pointColor: "rgba(100,110,120,1)",
                  pointStrokeColor: "#fff",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(100,110,120,1)",
                  data: [
                  @php
                  for ($i=0; $i <= 11; $i++) {
                        $bulan = explode('-', date("m-Y", strtotime("-" . $i . " months")))[0];
                        $tahun = explode('-', date("m-Y", strtotime("-" . $i . " months")))[1];
                        $array[] = helper()->tidakMasuk(getUserData()->pegawai->id, $bulan, $tahun, 'c');            
                  }
                  foreach (array_reverse($array) as $item) {
                        echo '"'.$item.'",';
                   }
                   unset($array);
                  @endphp
                  ]
            }
      ]
};
var ctxl = $("#chartIjinAbsensi").get(0).getContext("2d");
var lineChart = new Chart(ctxl).Line(data, {
 responsive : true,
 animation: true,
 barValueSpacing : 5,
 barDatasetSpacing : 1,
 tooltipFillColor: "rgba(0,0,0,0.8)",                
 multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
});
</script>
@endsection