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
                    <a href="#" class=" dropdown-toggle" data-toggle="dropdown"><i class="fa fa-lock"></i> Đăng nhập</a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-login-box animated fadeInUp">
                        <form role="form">
                            <h4>Signin</h4>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" placeholder="Username">
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="checkbox pull-left">
                                    <label>
                                        <input type="checkbox"> Remember me
                                    </label>
                                </div>
                                <a class="btn btn-theme-bg pull-right">Login</a>
                                <!--                                        <button type="submit" class="btn btn-theme pull-right">Login</button>                 -->
                                <div class="clearfix"></div>
                                <hr>
                                <p>Don't have an account! <a href="/register">Register Now</a></p>
                            </div>
                        </form>
                    </div>
                </li> <!--menu login li end here-->
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--container-->
</div><!--navbar-default-->