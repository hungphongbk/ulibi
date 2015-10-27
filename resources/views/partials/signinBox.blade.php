{!! Form::open(array(
    "route" => "ulibier.postLogin",
    "role" => "form",
    "style" => "width: 300px"
    )) !!}

    {!! Form::token() !!}

    <h4>Đăng nhập</h4>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            {!! Form::email("email", null, [ "class" => "form-control", "placeholder" => "E-mail" ]) !!}
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            {!! Form::password("password", [ "class" => "form-control", "placeholder" => "Password" ]) !!}
        </div>
        <div class="checkbox pull-left">
            <label>
                <input type="checkbox"> Remember me
            </label>
        </div>

        {!! Form::submit("Đăng nhập", [ "class" => "btn btn-theme-bg pull-right" ]) !!}
        <a href="{{ url("ulibier/social/facebook") }}" class="btn btn-fb-login pull-right"><i class="fa fa-facebook"></i> Đăng nhập với Facebook</a>
        <a href="{{ url("ulibier/social/google") }}" class="btn btn-gg-login pull-right"><i class="fa fa-google-plus"></i> Đăng nhập với Google+</a>
        <div class="clearfix"></div>
        <hr>
        <p>Bạn chưa có tài khoản Ulibi? <a href="{{ url('/ulibier/register') }}">Đăng kí nào!!!</a></p>
    </div>
{!! Form::close() !!}