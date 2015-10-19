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
    @include('includes.templates.postDetail',['article' => $article])
    <h2><a href="{{ $article->view_url }}">{{ $article->article_title }}</a></h2>
    <p>{{ str_limit($article->article_content,200) }}</p>
    <p><a href="{{ $article->view_url }}" class="btn btn-theme-dark">Xem thêm...</a></p>
</div>