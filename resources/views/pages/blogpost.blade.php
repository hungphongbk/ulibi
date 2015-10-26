@extends('layouts.default')
@section('title','WRITE NEW POST')
@section('content')
    <div id="destination-choose" class="drag-drop-animation" style="background-image: url(data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==);">
        <div>
            <i class="fa fa-3x fa-camera" style="margin-right: 0.3em;line-height: 240px;"></i>
            <span style="line-height: 240px; font-size: 24px;display: inline-block; vertical-align: bottom;">
                Kéo thả hoặc click vào đây để tạo một bức cover đẹp cho bài viết bạn nhé ^^
            </span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-offset-1 margin30 sky-form-columns contact-sky-option">
                <div class="row margin40">
                </div>
                {!! Form::model($model, array(
                    'route'     => $action,
                    'method'    => $method,
                    'id'        => 'sky-form',
                    'class'     => 'sky-form sky-form-columns'
                     )) !!}

                <fieldset>
                    <div class="row">
                        <section class="section-3x no-border">
                            <label class="input">
                                {!! Form::text("article_title", null, array(
                                'id'            => 'name',
                                'placeholder'   => 'Tiêu đề'
                                )) !!}
                            </label>
                        </section>
                    </div>
                    <div class="row">
                        <section>
                            <ul class="list-inline new-blog-author-detail">
                                <?php
                                    $user=Auth::user();
                                    ?>
                                <li>
                                    <div style="width: 40px; height: 40px;" class="ratio-500-500"><img class="img-responsive avatar" src="{{ $user->avatar_url }}" alt="avatar of {{ $user->full_name }}"></div>
                                </li>
                                <li>
                                    <span>{{ $user->full_name }}</span>
                                </li>
                                <li><span>&#183;</span></li>
                                <li>
                                    <span>{{ date('d M Y') }}</span>
                                </li>
                            </ul>
                        </section>
                    </div>
                    <div class="row" style="margin-left: -30px; margin-right: -30px;">
                        <section class="col col-6">
                            <label class="input">
                                <input type="text" name="tagnames" id="tagnames" placeholder="Tags" >
                            </label>
                        </section>
                        <section class="col col-6">
                            <label class="input">
                                <!--<i class="icon-append fa fa-map-marker"></i>-->
                                <input type="text" name="destinations" id="destinations" placeholder="Địa điểm" >
                            </label>
                        </section>
                    </div>
                    <div class="row">
                        <section>
                            @include('partials.editorBar')
                            <div id="editor" class="textarea-wysiwyg" data-placeholder="Content goes here..."></div>
                    </section>
                    </div>
                </fieldset>

                {!! Form::hidden('article_content', null,array('id' => 'blogContent')) !!}
                {!! Form::hidden('article_date', date('Y-m-d H:i:s')) !!}
                {!! Form::hidden('article_content_type', 'html') !!}
                {!! Form::hidden('cover_id', null, array( "id" => "cover_id" )) !!}

                <footer>
                    <ul class="list-inline">
                        <li>
                            <div id="articlePreview" href="#articlePreviewPage" class="btn btn-theme-dark btn-lg">Xem trước</div>
                        </li>
                        <li>
                            {!! Form::submit("Lưu bài viết", array( "class" => "btn btn-theme-bg btn-lg" )) !!}
                        </li>
                    </ul>
                </footer>

                <div class="message">
                    <i class="fa fa-check"></i>
                    <p>Your message was successfully sent!</p>
                </div>
                {!! Form::close() !!}
    						
            </div>

        </div>
    </div><!--contact advanced container end-->
    <div class="divide60"></div>
    <div data-id="destination-choose" style="display: none">
        <h3>XIN LỖI, TÍNH NĂNG NÀY CHƯA ĐƯỢC HIỆN THỰC XONG :)</h3>
    </div>
    <div id="articlePreviewPage" class="mfp-hide mfp-dialog-zoom-in article-preview-page">
        <div class="blog-post">
            <div class="ratio-1920-850 fix-padding-ltr-20 background">
            </div>
            <!-- POST DETAIL HERE -->
            <h2>TITLE</h2>
            <div class="content">

            </div>
        </div><!--about author-->
    </div>
@stop
@section('head-page-scripts')
    <link href="sky-form/css/sky-forms.css" rel="stylesheet">
    <link rel="stylesheet" href="flavr/animate.css">
    <link rel="stylesheet" href="flavr/flavr.css">
    <script>
        var textextCss=['textext.core','textext.plugin.autocomplete','textext.plugin.tags'];
        textextCss.forEach(function(e){
            var styleRef=document.createElement('link');
            styleRef.setAttribute('rel','stylesheet');
            styleRef.setAttribute('type','text/css');
            styleRef.setAttribute('href','jquery-textext-master/src/css/'+e+'.css');
            if(typeof styleRef!=='undefined') {
                var firstLink=document.getElementsByTagName('link')[0];
                firstLink.parentNode.insertBefore(styleRef,firstLink.nextSibling);
            }
        })
    </script>
    <style>
        #destination-choose {
            cursor: pointer;
            height: 240px;
            background-size: cover;
            background-position: center;
            color: #888;
            text-align: center;
        }
        #destination-choose.has-image {
            cursor: default;
            height: 320px;
        }
        #editor {
            overflow:scroll;
            height:300px;
        }
        .btn-toolbar {
            margin-bottom: 10px;
        }
        .btn-toolbar .btn[data-edit]:not(.dropdown-toggle) {
            width: 39px;
        }
        .btn-toolbar i.fa:last-child {
            margin-right: 0;
        }
        .flavr-container .flavr-fixer .flavr-outer {
            background: #EFEFEF;
        }
    </style>
@stop
@section('post-page-scripts')
    <script src="git/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="git/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="flavr/flavr.min.js"></script>
    <script>
        var blogContent=$('#blogContent');
        var editor=$('#editor');
        $(editor).wysiwyg().on('change',function(){
            $(blogContent).val($(editor).cleanHtml());
        });
        if ($(blogContent).val().length>0)
            $(editor).html($(blogContent).val());

        var destinationChoose=document.getElementById('destination-choose');
        if($('#cover_id').val()>0){
            $(destinationChoose).addClass('has-image')
                    .css('background-image','url({{ $model->thumbnail_1200 }}})')
        }
        $(destinationChoose).click(function(){
            var content=$('[data-id="destination-choose"]').clone();
            $(content).attr('id',$(content).data('id')).show();
            new $.flavr({
                html:true,
                title:'CHECK-IN ĐỊA ĐIỂM',
                content:content
            });
        });

        var holder=document.getElementById('destination-choose');
        $(holder).UlibiPhotoDragDrop({
            debug: true,
            callback: function(data){
                $('#cover_id').val(data.id);
            }
        });
        $('#articlePreview').magnificPopup({
            type: 'inline',
            preloader: false,
            mainClass: 'mfp-dialog',
            removalDelay: 250,
            callbacks: {
                beforeOpen: function(){
                    var page=document.getElementById('articlePreviewPage');
                    var coverSrc=$('#destination-choose').css('background-image');
                    $(page).find('.background:first').css('background-image',coverSrc);
                    var title=$('#name').val();
                    $(page).find('h2:first').html(title);
                    var content=$('#blogContent').val();
                    $(page).find('div.content:first').html(content);

                }
            }
        });
    </script>
    <script src="jquery-textext-master/src/js/textext.core.js" type="text/javascript"></script>
    <script src="jquery-textext-master/src/js/textext.plugin.autocomplete.js" type="text/javascript"></script>
    <script src="jquery-textext-master/src/js/textext.plugin.tags.js" type="text/javascript"></script>
    <script>
        var t=document.getElementById('tagnames');
        $(t).UlibiTagEditor({
            debug: true,
            wrapClass: 'text-core-skyform-style',
            tags: JSON.parse('{!! $tags !!}'),
            itemManager: new $.Ulibi.TagItem()
        });
        $('#destinations').UlibiTagEditor({
            debug: true,
            wrapClass: 'text-core-skyform-style',
            tags: JSON.parse('{!! $dest !!}'),
            itemManager: new $.Ulibi.DestinationItem()
        })
    </script>
@stop