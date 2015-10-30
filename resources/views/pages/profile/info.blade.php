<div class="container">
    <div class="row">
        <div class="divide40"></div>
        <div class="col-sm-6 margin30">
            <div class="panel modern-panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">Về bản thân tôi</h4>
                </div>
                <div class="panel-body">
                    <h5 class="text-muted">Giới thiệu</h5>
                    @if(empty($profile->aboutme_description))
                        <p class="text-muted">Chưa có thông tin</p>
                    @else
                        <p class="text-info">{{ $profile->aboutme_description }}</p>
                    @endif
                    <br>
                    <h5 class="text-muted">Câu nói ưa thích</h5>
                    @if(empty($profile->aboutme_quotes))
                        <p class="text-muted">Chưa có thông tin</p>
                    @else
                        <p class="text-info">{{ $profile->aboutme_quotes }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-6 sky-form-login-register v2">
            <div class="panel modern-panel panel-danger">
                <div class="panel-heading">
                    <h4 class="panel-title">Thông tin cá nhân</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <h5 class="text-muted col-fixed-sm-200">Sinh nhật</h5>
                        <p class="text-danger">{{ $profile->birthday->formatLocalized('%d %B %Y') }}
                            (<strong>{{ Carbon\Carbon::now()->diff($profile->birthday)->y }}</strong> tuổi)</p>
                        <h5 class="text-muted col-fixed-sm-200">Nơi ở hiện tại</h5>
                        <p class="text-danger">{{ $profile->basicinfo_currentPlace }}</p>
                        <h5 class="text-muted col-fixed-sm-200">Nghề nghiệp</h5>
                        <p class="text-danger">{{ $profile->basicinfo_job }}</p>
                        <h5 class="text-muted col-fixed-sm-200">Sở thích</h5>
                        <p class="text-danger">{{ $profile->basicinfo_hobbies }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>