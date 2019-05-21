@php
$absensisToday = $pegawai->absensisToday;
$countAbsensisToday = count($absensisToday);
@endphp

@extends('template.template')

@section('title')
Absensi
@endsection

@section('nav')
@include('absensi.nav')
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Absensi</h3>
            </div>

            <form action="{{base_url()}}absensi/absen" method="post" role="form" enctype="multipart/form-data">
                <div class="box-body">

                    <!-- Markers -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="map" style="height: 400px; width: 100%;" class="gmap"></div>
                        </div>
                    </div>
                    <!-- #END# Markers -->

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        @php
                        if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('lat')) {
                            $class = 'form-group has-feedback has-error';
                            $message = ci()->session->flashdata('errors')->first('lat');
                        } else {
                            $class = 'form-group has-feedback';
                            $message = '';
                        }

                        if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['lat']) {
                            $value = ci()->session->flashdata('old')['lat'];
                        } elseif (isset($pegawai) && $pegawai['lat']) {
                            $value = $pegawai['lat'];
                        } else {
                            $value = '';
                        }
                        @endphp
                        <div class="{{$class}}">
                            <label for="lat" data-toggle="tooltip" title="{{$message}}">Lat</label>
                            <div data-toggle="tooltip" title="{{$message}}">
                                <input type="text" name="lat" class="form-control" placeholder="Isi Lat" id="lat" value="{{$value}}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        @php
                        if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('lng')) {
                            $class = 'form-group has-feedback has-error';
                            $message = ci()->session->flashdata('errors')->first('lng');
                        } else {
                            $class = 'form-group has-feedback';
                            $message = '';
                        }

                        if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['lng']) {
                            $value = ci()->session->flashdata('old')['lng'];
                        } elseif (isset($pegawai) && $pegawai['lng']) {
                            $value = $pegawai['lng'];
                        } else {
                            $value = '';
                        }
                        @endphp
                        <div class="{{$class}}">
                            <label for="lng" data-toggle="tooltip" title="{{$message}}">Lng</label>
                            <div data-toggle="tooltip" title="{{$message}}">
                                <input type="text" name="lng" class="form-control" placeholder="Isi Lng" id="lng" value="{{$value}}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="lokasi" value="" id="lokasi">
                                <label for="textlokasi">Lokasi</label>
                                <input type="text" name="textlokasi" class="form-control" id="textlokasi" readonly placeholder="Kantor / Dinas Luar" value="">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <div>
                                <label for="textwaktu">Waktu</label>
                                <input type="text" name="textwaktu" class="form-control" id="textwaktu" readonly placeholder="" value="">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <div>
                                <label for="texttipe">Tipe</label>
                                @php
                                if ($countAbsensisToday == 0) {
                                    $value = "Berangkat";
                                } elseif ($countAbsensisToday == 1) {
                                    $value = "Pulang";
                                } else {
                                    $value = "#N/A";
                                }
                                @endphp
                                <input type="text" name="texttipe" class="form-control" id="texttipe" readonly value="{{$value}}">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="form-group">
                        <div>
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" class="form-control" id="foto">
                        </div>
                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{base_url()}}absensi" class="btn btn-info">Batal</a>
                    <button type="button" class="btn btn-danger" onclick="getLocation()">Get Location</button>
                    <button type="button" class="btn btn-danger" onclick="cekDilokasiApaEnggak()">Check Location</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$("form").submit(function(e) {
    e.preventDefault();

    @if(helper()->apakahHariIniIjin())
    swal('Error', 'Hari Ini Anda Ijin Tidak Absen !!!', 'error');

    return false;
    @elseif(helper()->apakahLibur())
    swal('Error', 'Hari Ini Libur !!!', 'error');

    return false;
    @elseif($countAbsensisToday > 1)
    swal('Error', 'Anda tidak bisa absen lagi !!!', 'error');

    return false;
    @endif

    cekDilokasiApaEnggak();

    if ($("#lat").val() == '') {
        swal('Error', 'Data Latitude Tidak Ada !!!', 'error');

        return false;
    }

    if ($("#lng").val() == '') {
        swal('Error', 'Data Longitude Tidak Ada !!!', 'error');

        return false;
    }

    if ($("#lokasi").val() == '') {
        swal('Error', 'Data Lokasi Tidak Ada !!!', 'error');

        return false;
    }

    if ($("#tipe").val() == '') {
        swal('Error', 'Data Tipe Tidak Ada !!!', 'error');

        return false;
    }

    if ($("#foto").val() == '') {
        swal('Error', 'Data Foto Tidak Ada !!!', 'error');

        return false;
    }

    $("form").unbind("submit").submit();
})

$(function() {
    getLocation();

    updateWaktu();
    setInterval(updateWaktu, 1000);
});

state.data.date = null;

var updateWaktu = function () {
    state.data.date = moment(new Date());

    $("#textwaktu").val(momentParseToDateTimeIndo(state.data.date));
};

</script>


<script>
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

  function cekDilokasiApaEnggak()
  {
    try {
        if (google.maps.geometry.poly.containsLocation(state.data.mapslatlng, state.data.polygon)) {
            $("#lokasi").val('d');
            $("#textlokasi").val('Kantor');
        } else {
            $("#lokasi").val('l');
            $("#textlokasi").val('Dinas Luar');
        }
    } catch(e) {
        swal('ERROR !!!', e.message, 'error');
    }
  }
</script>

<!-- geolocation -->
<script>
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
        $("#textlokasi").val('');
    } else { 
        swal('ERROR !!!', "Geolocation is not supported by this browser.", 'error');
    }
}

function showPosition(position) {
    state.data.lat = position.coords.latitude;
    state.data.lng = position.coords.longitude;
    state.data.latlng = {
        lat: state.data.lat,
        lng: state.data.lng,
    };
    state.data.mapslatlng = new google.maps.LatLng(state.data.lat, state.data.lng);

    $("#lat").val(state.data.lat);
    $("#lng").val(state.data.lng);

    initMap();
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            swal('ERROR !!!', "User denied the request for Geolocation.", 'error');
            break;
        case error.POSITION_UNAVAILABLE:
            swal('ERROR !!!', "Location information is unavailable.", 'error');
            break;
        case error.TIMEOUT:
            swal('ERROR !!!', "The request to get user location timed out.", 'error');
            break;
        case error.UNKNOWN_ERROR:
            swal('ERROR !!!', "An unknown error occurred.", 'error');
            break;
    }
}
</script>
<!-- geolocation -->
@endsection