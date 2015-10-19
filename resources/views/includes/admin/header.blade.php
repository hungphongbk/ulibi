<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">ULIBI Administrator</a>
        </div>
        @if(!Auth::guest())
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Content management <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="admin/#/dest/view">Destinations</a></li>
                        <li><a href="admin/#/articles/view">Articles</a></li>
                        <li><a href="#">Dummy</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Dummy 1</a></li>
                        <li><a href="#">Dummy 2</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a>{{ Auth::user()->username }}</a>
                </li>
                <li><a href="/admin/logout">Logout</a></li>
            </ul>
        @endif
        </div><!--/.nav-collapse -->
    </div>
</nav>