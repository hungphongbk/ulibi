<form role="form" method="POST" action="{{ url('/ulibier/login') }}">
    <h4>Signin</h4>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" placeholder="Username" name="username">
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
        <!--                                        <button type="submit" class="btn btn-theme pull-right">Login</button>                 -->
        <div class="clearfix"></div>
        <hr>
        <p>Bạn chưa có tài khoản Ulibi? <a href="{{ url('/ulibier/register') }}">Đăng kí nào!!!</a></p>
    </div>
</form>