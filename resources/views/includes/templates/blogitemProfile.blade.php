<div class="blog-post blog-profile col-md-4 col-sm-6">
    <div class="blog-profile-wrapper">
        <a href="#">
            <div class="ratio-1920-850 thumbnail overlay-animation">
                <div class="background" style="background-image: url('{{ $article->thumbnail }}')"></div>
                <div class="wrapper">
                    <span class="overlay-frame"></span>
                </div>
            </div>
        </a><!--work link-->
        @include('includes.templates.postDetail',['article' => $article])
        <h2>
            {!! link_to_route("blog.show", $article->article_title, $article->article_id ) !!}
        </h2>
        <p>{{ str_limit($article->content_as_plain_text,200) }}</p>
        <p>
            {!! link_to_route("blog.show", "Xem thêm...", $article->article_id, [ "class" => "btn btn-theme-dark" ] ) !!}
            <a href="{{ $article->edit_url }}" class="btn btn-theme-dark">Chỉnh sửa</a>
            <a href="javascript:void(0)" data-action="deleteItem" data-title="{{ $article->article_title }}" data-href="{{ $article->view_url }}" class="btn btn-danger btn-ico">Xoá bài viết <i class="fa fa-trash"></i></a>
        </p>
    </div>
</div>