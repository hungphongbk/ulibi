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
                        <a href="#" ><i class="fa fa-user"></i> Đăng nhập rồi nhé </a>
                    @endif
                </li> <!--menu login li end here-->
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--container-->
</div><!--navbar-default-->