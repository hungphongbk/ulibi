<ul class="list-inline post-detail">
    <li><i class="fa fa-user"></i> <a href="#">{{ $article->ulibier->full_name }}</a></li>
    <li><i class="fa fa-calendar"></i>{{ $article->article_date->format('d M Y') }}</li>
    @if(isset($showCommentCount) && $showCommentCount)
        <li><i class="fa fa-comment"></i> <a href="#">6 Comments</a></li>
    @endif
</ul>