<div style="width: 96px; height: 96px;display: inline-block; margin-right: 20px; position: relative; vertical-align: top;">
	<img src="{{ Auth::user()->avatar_url }}" height="100%" width="100%" height="100%" style="border-radius: 48px;">
</div>
<div style="display: inline-block; font-family: 'Open Sans', sans-serif !important;">
	<p style="font-size: 16px;margin-bottom: 5px;">{{ Auth::user()->full_name }}</p>
	<p class="text-muted" style="font-size: 20px; font-weight: 500;margin-bottom: 5px;">&commat;{{ Auth::user()->username }}</p>
	<a href="{{ route("profile.index") }}" class="btn border-theme">XEM TRANG CÁ NHÂN</a>
</div>
<hr />
<a class="btn btn-theme-dark" href="ulibier/logout">Đăng xuất</a>