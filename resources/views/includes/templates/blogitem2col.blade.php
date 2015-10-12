<div class="blog-post mansory-child">
    <a href="#">
        <div class="ratio-1920-850 hover-zoomout-darken">
            <div class="wrapper">
                @if(is_null($article->first_related_destination))
                    <img src="img/showcase-2.jpg" class="img-responsive" alt="workimg">
                @else
                    <img src="{{ $article->first_related_destination->avatar }}" class="img-responsive" alt="workimg">
                @endif
            </div>
        </div>
    </a><!--work link-->
    <ul class="list-inline post-detail">
        <li>by <a href="#">{{ $article->ulibier->username }}</a></li>
        <li><i class="fa fa-calendar"></i>{{ $article->article_date->format('d M Y') }}</li>
        <li><i class="fa fa-tag"></i> <a href="#">Sports</a></li>
    </ul>
    <h2><a href="#">{{ $article->article_title }}</a></h2>
    <p>{{ str_limit($article->article_content,200) }}</p>
    <p><a href="{{ url('blog/'.$article->article_id) }}" class="btn btn-theme-dark">Xem thêm...</a></p>
</div>