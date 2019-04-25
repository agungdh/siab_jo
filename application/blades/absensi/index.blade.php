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

            <form action="{{base_url()}}absensi/aksitambah" method="post" role="form">
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
                        } elseif (isset($karyawan) && $karyawan['lat']) {
                            $value = $karyawan['lat'];
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
                        } elseif (isset($karyawan) && $karyawan['lng']) {
                            $value = $karyawan['lng'];
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

<!-- map -->
<script async defer 
    src="https://maps.googleapis.com/maps/api/js?key={{getenv('GMAPS_API_KEY')}}">
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

    state.data.polygonCoords = [
        new google.maps.LatLng(-5.093137,105.283660),
        new google.maps.LatLng(-5.093105,105.283996),
        new google.maps.LatLng(-5.093124,105.284159),
        new google.maps.LatLng(-5.093268,105.284291),
        new google.maps.LatLng(-5.093431,105.284258),
        new google.maps.LatLng(-5.093565,105.284146),
        new google.maps.LatLng(-5.093653,105.283816),
        new google.maps.LatLng(-5.093618,105.283658),
        new google.maps.LatLng(-5.093589,105.283497),
        new google.maps.LatLng(-5.093471,105.283400),
        new google.maps.LatLng(-5.093225,105.283513)
    ];
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