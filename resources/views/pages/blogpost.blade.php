@extends('layouts.default')
@section('title','WRITE NEW POST')
@section('content')
    <!--<div class="breadcrumb-wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h4>NEW POST</h4>
                </div>
            </div>
        </div>
    </div>breadcrumbs-->
   
    <div id="destination-choose" class="drag-drop-animation">
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
                <form action="{{ $actionUrl }}" method="POST" id="sky-form" class="sky-form sky-form-columns">
                    <fieldset>
                        <div class="row">
                            <section class="section-3x no-border">
                                <label class="input">
                                    <input type="text" name="article_title" id="name" placeholder="Tiêu đề" value="{{ Input::get('article_title') }}">
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
                            <?php
                                $toolbar=[
                                    [
                                        array("icon"=>"text-height","dropdown"=>[
                                            array("text"=>"1","edit"=>"fontSize 1"),
                                            array("text"=>"2","edit"=>"fontSize 2"),
                                            array("text"=>"3","edit"=>"fontSize 3"),
                                            array("text"=>"4","edit"=>"fontSize 4"),
                                            array("text"=>"5","edit"=>"fontSize 5"),
                                            array("text"=>"6","edit"=>"fontSize 6"),
                                        ])
                                    ],
                                    [
                                        array("icon"=>"bold", "edit"=>"bold"),
                                        array("icon"=>"italic", "edit"=>"italic"),
                                        array("icon"=>"underline", "edit"=>"underline"),
                                        array("icon"=>"strikethrough", "edit"=>"strikethrough"),
                                    ],
                                    [
                                        array("icon"=>"list-ul", "edit"=>"insertunorderedlist"),
                                        array("icon"=>"list-ol", "edit"=>"insertorderedlist"),
                                        array("icon"=>"outdent", "edit"=>"outdent"),
                                        array("icon"=>"indent", "edit"=>"indent"),
                                    ],
                                    [
                                        array("icon"=>"align-left", "edit"=>"justifyleft"),
                                        array("icon"=>"align-center", "edit"=>"justifycenter"),
                                        array("icon"=>"align-right", "edit"=>"justifyright"),
                                        array("icon"=>"align-justify", "edit"=>"justifyfull"),
                                    ]
                                ]
                            ?>
                            <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">
                                @foreach ($toolbar as $group)
                                    <div class="btn-group btn-group-lg" role="group">
                                    @foreach($group as $button)
                                        @if(isset($button['dropdown']))
                                        <a class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-{{ $button['icon'] }}"></i><i class="fa fa-caret-down"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            @foreach($button['dropdown'] as $dropdown)
                                                <li>
                                                    <a data-edit="{{ $dropdown['edit'] }}">{{ $dropdown['text'] }}</a>
                                                </li>
                                                @endforeach
                                        </ul>
                                        @else
                                        <a class="btn btn-default" data-edit="{{ $button['edit'] }}">
                                            <i class="fa fa-{{ $button['icon'] }}"></i>
                                        </a>
                                        @endif
                                    @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <div id="editor" class="textarea-wysiwyg" data-placeholder="Content goes here..."></div>
                        </section>
                        </div>
                    </fieldset>
                    <input type="hidden" id="blogContent" name="article_content">
                    <input type="hidden" name="article_date" value="{{ date('Y-m-d H:i:s') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="article_content_type" value="html">
                    <input type="hidden" name="cover_id" id="cover_id" value="0">
                    <footer>
                        <ul class="list-inline">
                            <li>
                                <button id="articlePreview" class="btn btn-border-theme btn-lg ">Xem trước</button>
                            </li>
                            <li>
                                <button type="submit" class="btn btn-theme-bg btn-lg ">Lưu bài viết</button>
                            </li>
                        </ul>
                    </footer>

                    <div class="message">
                        <i class="fa fa-check"></i>
                        <p>Your message was successfully sent!</p>
                    </div>
                </form>
    						
            </div>

        </div>
    </div><!--contact advanced container end-->
    <div class="divide60"></div>
    <div data-id="destination-choose" style="display: none">
        <h3>XIN LỖI, TÍNH NĂNG NÀY CHƯA ĐƯỢC HIỆN THỰC XONG :)</h3>
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
            background-color: #eeeeee;
            color: #888;
            text-align: center;
        }
        #destination-choose.has-image {
            cursor: default;
            background-size: cover;
            height: 320px;
            background-position: center;
        }
        #destination-choose.has-image *{
            /*display: none !important;*/
        }
        #editor {
            overflow:scroll;
            height:300px;
        }
        .btn-toolbar {
            margin-bottom: 10px;
        }
        .btn-toolbar .btn:not(.dropdown-toggle) {
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
    <script>
        var blogContent=$('#blogContent');
        var editor=$('#editor');
        $(editor).wysiwyg().on('change',function(){
            $(blogContent).val($(editor).cleanHtml());
        });
        if ($(blogContent).val().length>0)
            $(editor).html($(blogContent).val());
    </script>
    <script src="flavr/flavr.min.js"></script>
    <script>
        $('#destination-choose').click(function(){
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
        $('#articlePreview').click(function(e){
            alert('Tính năng này hiện đang trong giai đoạn phát triển :)');
            e.preventDefault();
            return false;
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