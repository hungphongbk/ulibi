@extends('layouts.default')
@section('title','WRITE NEW POST')
@section('content')
<link href="sky-form/css/sky-forms.css" rel="stylesheet">
<div class="breadcrumb-wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h4>NEW POST</h4>
                </div>
            </div>
        </div>
    </div><!--breadcrumbs-->
   
    <div class="divide60"></div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-offset-1 margin30 sky-form-columns contact-sky-option">
                <div class="row">
                    <div class="col-md-12">
                        <div class="center-heading">
                            <h2>Write a new blog</h2>
                            <span class="center-line"></span>
                            <p class="hidden">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </p>
                        </div>
                    </div>                   
                </div><!--center heading row-->
                <div class="row margin40">
                
                    
                </div>
                    <form action="/" method="get" id="sky-form" class="sky-form sky-form-columns">
			
			
			<fieldset>					
				<div class="row">
					<section>
						
						<label class="input">
							<i class="icon-append fa fa-user"></i>
                                                            <input type="text" name="name" id="name" placeholder="Title">
                                                            <b class="tooltip tooltip-top-right">Title</b>
						</label>
					</section>
				</div>
				<div class="row">
					<section>
						
						<label class="input">
							<i class="icon-append fa fa-user"></i>
                                                            <input type="text" name="name" id="name" placeholder="Tags">
                                                            <b class="tooltip tooltip-top-right">Tags</b>
						</label>
					</section>
				</div>
				<div class="row">
				<section>
					
					<label class="textarea">
						<i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="20" name="message" id="message" placeholder="Content goes here..."></textarea>
                                                     <b class="tooltip tooltip-top-right">Content goes here...</b>
					</label>
				</section>
				</div>
				<section class="hidden">
					<label class="checkbox"><input type="checkbox" name="copy"><i></i>Send a copy to my e-mail address</label>
				</section>
			</fieldset>
			
			<footer>
				<button type="submit" class="btn btn-theme-bg btn-lg ">Publish</button>
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
@stop