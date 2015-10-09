@extends('layouts.default')
@section('title','MAP')
@section('content')
<div class="breadcrumb-wrap">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h4>MAP</h4>
            </div>
        </div>
    </div>
</div><!--breadcrumbs-->
<div class="container">
  <div class="row">
    <div id="map-canvas"></div>
  </div>
</div><!--.container-->
<div class="divide60"></div>

<div class="container">
  <div class="row">
    <ul class="nav nav-pills">
      <li class="active"><a data-toggle="pill" href="#tab1">Giới thiệu</a></li>
      <li><a data-toggle="pill" href="#tab2">Ảnh</a></li>
      <li><a data-toggle="pill" href="#tab3">Bài viết</a></li>
      <li><a data-toggle="pill" href="#tab4">Hỏi đáp</a></li>
    </ul>
    <div class="tab-content">
      <div id="tab1" class="tab-pane fade in active">
        <h3>PHAN XI PĂNG</h3>
        <h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, tenetur!</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet, ad. Odit ab dignissimos maiores error nemo voluptatem delectus voluptas saepe eligendi aut atque libero dicta nesciunt, suscipit deserunt praesentium nulla eveniet voluptatum consectetur officia quibusdam? Aliquid quo suscipit earum reprehenderit quidem quis. Excepturi ex odit, illo, eos in iusto pariatur sunt deserunt omnis recusandae facere earum incidunt adipisci deleniti debitis quis nisi tempora ipsum error. Necessitatibus molestias, inventore, in consectetur numquam itaque et. Illum cum, sit natus explicabo nisi dolore. Similique modi facere fugit nesciunt earum, unde repellat! Exercitationem necessitatibus veniam voluptatum vero eaque quia est odit sapiente facilis fuga.</p>
        
      </div>
      <div id="tab2" class="tab-pane fade">
        <div id="grid" class="row">
            @for($i=0;$i<12;$i++)
            <div class="mix col-sm-3 margin30">
                <div class="item-img-wrap ">
                    <img src="img/img-1.jpg" class="img-responsive" alt="workimg">
                    <div class="item-img-overlay">
                        <a href="img/img-1.jpg" class="show-image">
                            <span></span>
                        </a>
                    </div>
                </div> 

            </div>
            @endfor
        </div>
      </div>
      <div id="tab3" class="tab-pane fade">
        <h3>BÀI VIẾT</h3>
        <div class="row">
          @for($i=0;$i<6;$i++)
          <div class="col-md-4">
            <div class="blog-post">
              <a href="#">
                <div class="item-img-wrap">
                    <img src="img/showcase-4.jpg" class="img-responsive" alt="workimg">
                    <div class="item-img-overlay">
                        <span></span>
                    </div>
                </div>                       
              </a><!--work link-->
              <ul class="list-inline post-detail">
                  <li>by <a href="#">assan</a></li>
                  <li><i class="fa fa-calendar"></i> 31st july 2014</li>
                  <li><i class="fa fa-tag"></i> <a href="#">Sports</a></li>
                  <li><i class="fa fa-comment"></i> <a href="#">6 Comments</a></li>
              </ul>
              <h2><a href="#">Lorem ipsum dollor sit amet</a></h2>

              <p><a href="blog-single.html" class="btn btn-theme-dark">Read More...</a></p>
            </div><!--blog post-->
          </div>
          @endfor
        </div>
      </div>
      <div id="tab4" class="tab-pane fade">
        <h3>Menu 2</h3>
        <p>Some content in menu 2.</p>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
    var myLatlng;
    var map;
    var marker;

    function initialize() {
        myLatlng = new google.maps.LatLng(10.7723044, 106.6576478);

        var mapOptions = {
            zoom: 13,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
            draggable: true
        };
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        var contentString = '<p style="line-height: 20px;"><strong>assan Template</strong></p><p>Vailshali, assan City, 302012</p>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'Marker'
        });

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);

    var mapHeight=window.innerHeight-70-89;
    document.getElementById('map-canvas').style.height=mapHeight+'px';
</script>
@stop