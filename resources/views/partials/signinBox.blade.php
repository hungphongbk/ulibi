<form role="form" method="POST" action="{{ url('/ulibier/login') }}" style="width: 300px;">
    <h4>Đăng nhập</h4>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="email" class="form-control" placeholder="Email" name="email">
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input type="password" class="form-control" placeholder="Password" name="password">
        </div>
        <div class="checkbox pull-left">
            <label>
                <input type="checkbox"> Remember me
            </label>
        </div>
        <button type="submit" class="btn btn-theme-bg pull-right">Đăng nhập</button>
        <a href="{{ URLExt::socialLoginUrl('facebook') }}" class="btn btn-fb-login pull-right"><i class="fa fa-facebook"></i> Đăng nhập với Facebook</a>
        <a href="{{ URLExt::socialLoginUrl('google') }}" class="btn btn-gg-login pull-right"><i class="fa fa-google-plus"></i> Đăng nhập với Google+</a>
        <div class="clearfix"></div>
        <hr>
        <p>Bạn chưa có tài khoản Ulibi? <a href="{{ url('/ulibier/register') }}">Đăng kí nào!!!</a></p>
    </div>
</form>