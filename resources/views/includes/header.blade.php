<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '980068488717110',
            xfbml      : true,
            version    : 'v2.5'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<div class="navbar navbar-default navbar-static-top yamm sticky" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="img/logo.jpg" alt="ULIBI"></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <!--menu home li end here-->
                <!--menu Portfolio li end here-->
                <li>
                    <a href="blog">Blogs</a>
                </li>
                <li>
                    <a href="map">Bản đồ</a>
                </li>
                <li>
                    <a href="photo">Hình ảnh</a>
                </li>
                <li>
                    <a href="profile">Trang của tôi</a>
                </li>
                <li class="dropdown " data-animate="animated fadeInUp" style="z-index:500;">
                    <a href="#" class="dropdown-toggle " data-toggle="dropdown"><i class="fa fa-search"></i> tìm kiếm</a>
                    <ul class="dropdown-menu search-dropdown animated fadeInUp">
                        <li id="dropdownForm">
                            <div class="dropdown-form">
                                <form class=" form-inline">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="search...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-theme-bg" type="button">Go!</button>
                                        </span>
                                    </div><!--input group-->
                                </form><!--form-->
                            </div><!--.dropdown form-->
                        </li><!--.drop form search-->
                    </ul><!--.drop menu-->
                </li>
                <li class="dropdown">
                    @if(Auth::guest())
                        <a href="#" class=" dropdown-toggle" data-toggle="dropdown"><i class="fa fa-lock"></i> Đăng nhập</a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-login-box animated fadeInUp">
                            @include('partials.signinBox')
                        </div>
                    @else
                        <img src="{{ Auth::user()->avatar_url }}" height="40px" width="40px" style="float: left; margin-top: 4px;border-radius: 20px;border: 1px solid #bbb;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin-left: 35px;">{{ Auth::user()->full_name }}</a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-login-box animated fadeInUp" style="white-space: nowrap; padding-left: 20px !important; padding-right: 20px !important;">
                            @include('partials.userinfoBox',['user'=>Auth::user()])
                        </div>
                    @endif
                </li> <!--menu login li end here-->
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--container-->
</div><!--navbar-default-->