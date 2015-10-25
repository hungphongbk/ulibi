<div class="blog-post mansory-child">
    <a href="#">
        <div class="ratio-1920-850 thumbnail overlay-animation">
            <div class="background" style="background-image: url('{{ $article->thumbnail }}')"></div>
            <div class="wrapper">
                <span class="overlay-frame"></span>
            </div>
        </div>
    </a><!--work link-->
    @include('includes.templates.postDetail',['article' => $article])
    <h2><a href="{{ $article->view_url }}">{{ $article->article_title }}</a></h2>
    <p>{{ str_limit($article->content_as_plain_text,200) }}</p>
    <p><a href="{{ $article->view_url }}" class="btn btn-theme-dark">Xem thêm...</a></p>
</div>