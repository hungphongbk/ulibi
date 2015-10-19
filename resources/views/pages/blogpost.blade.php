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
   
    <div id="destination-choose" style="height: 240px;background-color: #eeeeee; color: #888;text-align: center;">
        <i class="fa fa-3x fa-globe" style="margin-right: 0.3em;line-height: 240px;"></i>
        <span style="line-height: 240px; font-size: 24px;display: inline-block; vertical-align: bottom;">
            Bạn viết về địa điểm nào? Check-in tại đây nhé :)
        </span>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-offset-1 margin30 sky-form-columns contact-sky-option">
                <div class="row margin40">
                </div>
                <form action="/" method="get" id="sky-form" class="sky-form sky-form-columns">
			    <fieldset>
				<div class="row">
					<section class="section-3x no-border">
						<label class="input">
                            <input type="text" name="article_title" id="name" placeholder="Tiêu đề">
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
				<div class="row">
					<section>
						
						<label class="input">
                            <input type="text" name="name" id="name" placeholder="Tags">
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
                    <input type="hidden" name="article_date" value="{{ date('d M Y') }}">
			<footer>
				<ul class="list-inline">
                    <li>
                        <button class="btn btn-border-theme btn-lg ">Xem trước</button>
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
        <h3>FUCK YOUR MOTHER</h3>
    </div>
@stop
@section('head-page-scripts')
    <link href="sky-form/css/sky-forms.css" rel="stylesheet">
    <link rel="stylesheet" href="flavr/animate.css">
    <link rel="stylesheet" href="flavr/flavr.css">
    <style>
        #destination-choose {
            cursor: pointer;
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
        $('#editor').wysiwyg().on('change',function(){
            console.log($('#editor').cleanHtml());
        });
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
        })
    </script>
@stop