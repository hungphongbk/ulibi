<div class="blog-post blog-left-img">
    <div class="row">
        <div class="col-md-6 margin-20">
            <a href="#">
                <div class="ratio-500-333 thumbnail hover-zoomout-darken" style="background-image: url('{{ $article->first_related_destination->avatar }}')">
                </div>
            </a><!--work link-->
        </div>
        <div class="col-md-6 margin-20">
            @include('includes.templates.postDetail',['article' => $article])
            <h2><a href="{{ $article->view_url }}">{{ $article->article_title }}</a></h2>
            <p>{{ str_limit($article->content_as_plain_text,200) }}</p>
            <p>
                <a href="{{ $article->view_url }}" class="btn btn-theme-dark">Xem thêm...</a>
                <a href="javascript:void(0)" data-action="deleteItem" data-title="{{ $article->article_title }}" data-href="{{ $article->view_url }}" class="btn btn-danger btn-ico">Xoá bài viết <i class="fa fa-trash"></i></a>
            </p>
        </div>
    </div>
</div>