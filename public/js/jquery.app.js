(function(){!function(t){var e,n,a,i;return n=function(){function t(){}return t.prototype.stringToItem=function(t){return{tag_id:0,tag_name:t}},t.prototype.itemToString=function(t){return t.tag_name},t.prototype.compareItems=function(t,e){return t.tag_id===e.tag_id},t}(),e=function(){function t(){}return t.prototype.stringToItem=function(t){return{des_name:t}},t.prototype.itemToString=function(t){return t.des_name},t.prototype.compareItems=function(t,e){return t.des_name===e.des_name},t}(),i=function(e){var n;return n={uploadExisting:0,data:"",uploadUrl:"/photo",getToken:function(){return t('input[name="_token"]').val()},callback:function(){},onProgress:function(t){return console.log(t+"% complete")}},n=t.extend(n,e),t.ajax(n.uploadUrl,{type:"POST",data:(n.uploadExisting?"id=":"internal_url=")+n.data}).done(function(t){"function"==typeof n.callback&&n.callback(t)})},a=function(t){var e,n,a,i,o,r;for(o=t.split("&"),r={},e=0,a=o.length;a>e;e++)i=o[e],n=i.split("="),r[n[0]]=n[1];return r},t.Ulibi={TagItem:n,DestinationItem:e,uploadImage:i,parseQueryString:a},t.fn.extend({addClassIfExist:function(e){return this.each(function(){return t(this).hasClass(e)?t(this):t(this).addClass(e),this})},removeClassIfExist:function(e){return this.each(function(){return t(this).hasClass(e)?t(this).removeClass(e):t(this),this})},UlibiTagEditor:function(e){var n,a;return a={debug:!1,wrapClass:"",tags:[],itemManager:{}},a=t.extend(a,e),n=function(t){a.debug&&"undefined"!=typeof console&&null!==console&&console.log(t)},this.each(function(){return t(this).width(t(this).parent().innerWidth()-24),t(this).textext({plugins:"tags autocomplete",html:{wrap:'<div class="text-core '+a.wrapClass+'"><div class="text-wrap"></div></div>',tag:'<div class="text-tag"><div class="text-button"><span class="text-label"/><a class="custom-edit"/><a class="text-remove"><i class="fa fa-times"></i></a></div></div>'},ext:{itemManager:a.itemManager}}).bind("getSuggestions",function(e){return function(n,i){var o,r;return r=t(n.target).textext()[0],o=(i?i.query:"")||"",t(e).trigger("setSuggestions",{result:r.itemManager().filter(a.tags,o)})}}(this)),n("UlibiTagEditor worked!")})},UlibiPhotoDragDrop:function(e){var n,a;return a={debug:!1,html:{isDraggingClass:"is-dragging",isDropped:"is-dropped"},getToken:function(){return t('input[name="_token"]').val()},callback:function(){}},a=t.extend(a,e),n=function(t){a.debug&&"undefined"!=typeof console&&null!==console&&console.log(t)},this.each(function(){"undefined"==typeof window.FileReader&&alert("Trình duyệt của bạn không hỗ trợ kéo & thả File :)"),this.ondragover=function(){return!1},this.ondragend=function(){return!1},this.ondragenter=function(e){return e.stopPropagation(),e.preventDefault(),t(this).addClassIfExist(a.html.isDraggingClass),!1},this.ondragleave=function(){return t(this).removeClassIfExist(a.html.isDraggingClass),!1},this.ondrop=function(e){return function(i){var o,r;return i.stopPropagation(),i.preventDefault(),t(e).hasClass(a.html.isDropped)||t(e).addClass(a.html.isDropped),r=new FileReader,o=i.dataTransfer.files[0],r.onload=function(i){n("[UlibiPhotoDragDrop] file content length: "+i.target.result.length),t.Ulibi.uploadImage({uploadExisting:!1,data:i.target.result,getToken:a.getToken,callback:function(n){"succeeded"===n.status&&(t(e).hasClass("has-image")||t(e).addClass("has-image"),t(e).css("background-image","url("+i.target.result+")"),a.callback(n))}})},r.readAsDataURL(o),!1}}(this),n("UlibiPhotoDragDrop worked!")})},DeleteBlogArticle:function(e){var n,a;return a={debug:!1,csrf_token:"",alert:{title:"Are you sure?",text:"Bạn có chắc chắn muốn xoá bài viết <strong>{title}</strong> không?"},callback:function(){}},a=t.extend(a,e),n=function(t){a.debug&&"undefined"!=typeof console&&null!==console&&console.log(t)},this.each(function(){t(this).click(function(e){var n,i;n=t(e.target).attr("data-href"),i=t(e.target).attr("data-title"),swal({title:a.alert.title,text:a.alert.text.replace("{title}",i),type:"warning",showCancelButton:!0,confirmButtonColor:"#DD6B55",confirmButtonText:"Có, xoá nó đi :)",cancelButtonText:"Không :(",closeOnConfirm:!1,closeOnCancel:!0,showLoaderOnConfirm:!0,html:!0},function(){t.ajax({url:n,type:"DELETE",data:{_token:a.csrf_token},success:function(){return swal({title:"Success",text:"",type:"success"},a.callback)},error:function(){return swal({title:"Failed",text:"",type:"error"},a.callback)}})})}),n("DeleteBlogArticle plugin worked!")})},UlibiImageSelector:function(e){var n,a;return a={debug:!1,html:{uploaderId:"",parentId:"",childrenSelector:""},ajax:{url:"",method:"POST",dataTemplate:"key={0}"},callback:function(){return location.reload(!0)},uploadCallback:null},a=t.extend(a,e),n=function(t){a.debug&&"undefined"!=typeof console&&null!==console&&console.log(t)},this.each(function(){var e,i,o,r,l,s,c,u,d,f;i="btn-disabled",c=t(this).attr("href"),u=t(c).find("[data-role='change']"),f=t(a.html.uploaderId),l="data-selected",e=JSON.parse(atob(a.ajax)),o=function(i){return function(i){var o,r;o=e.dataTemplate.replace("{0}",i),n(i),r=!1,r||t.ajax({url:e.url,type:e.method,data:o,success:function(t){"OK"===t.status?(n("Change photo success, id="+i),a.callback()):n("Error expected, message: "+t.message)}})}}(this),d=function(e){return function(e){var n;return e.preventDefault(),t(u).hasClass(i)?void 0:(n=t(u).attr(l),o(n),!1)}}(this),s=function(n){return function(){var n;t(u).addClassIfExist(i),t(c).find(a.html.parentId).selectable({filter:a.html.childrenSelector,selected:function(e,n){t(u).removeClassIfExist(i).attr(l,t(n.selected).attr("data-photoid")).on("click",d)}}),n=a.uploadCallback,n||(n=function(t){o(t.id)}),t(f).UlibiPhotoDragDrop({debug:!0,getToken:function(){return t.Ulibi.parseQueryString(e.dataTemplate)._token},callback:n})}}(this),r=function(e){return function(){return t(c).find(a.html.parentId).selectable("destroy"),t(u).off()}}(this),t(this).magnificPopup({type:"inline",preloader:!1,mainClass:"mfp-dialog",callbacks:{beforeOpen:function(){s()},close:function(){r()}}}),n("UlibiImageSelector plugin worked!")})},UlibiProfileInformationEditor:function(e){var n,a;return a={debug:!1,html:{dialogSelector:"",formSelector:""},ajax:{url:"",method:"POST",dataTemplate:"key={0}"},callback:function(){return location.reload(!0)}},a=t.extend(a,e),n=function(t){a.debug&&"undefined"!=typeof console&&null!==console&&console.log(t)},this.each(function(){t(this).magnificPopup({type:"inline",preloader:!1,mainClass:"mfp-dialog",callbacks:{open:function(e){return function(){var n;n=t(e).attr("data-tab"),t(a.html.dialogSelector+' a[href="#tab-'+n+'"]').tab("show")}}(this),close:function(e){return function(){t(a.html.dialogSelector+' a[href="#tab-0"]').tab("show")}}(this)}}),n("UlibiProfileInformationEditor worked!")})},UlibiShowImage:function(e){var n,a;return a={debug:!1,html:{dialogSelector:"",formSelector:""}},a=t.extend(a,e),n=function(t){a.debug&&"undefined"!=typeof console&&null!==console&&console.log(t)},this.each(function(){var e,a,i,o,r,l;i=JSON.parse(atob(t(this).attr("data-encoded"))),e=JSON.parse(atob(t(this).attr("data-author-encoded"))),a=JSON.parse(atob(t(this).attr("data-content-encoded"))),l="1"===t(this).attr("data-own"),r=function(e){return t.ajax({type:"POST",url:"/ulibier/like",data:"content_id="+a.content_id,success:function(e){return function(a){n(e),"like"===a.action?t(e).find("i").removeClassIfExist("fa-heart-o").addClassIfExist("fa-heart"):t(e).find("i").removeClassIfExist("fa-heart").addClassIfExist("fa-heart-o"),t(e).next().text(a.like_count)}}(this)})},o=function(){var e;e=confirm("Bạn có chắc chắn muốn xoá ảnh này không?"),e&&t.ajax({type:"delete",url:"/photo/"+a.content_id,success:function(){return location.reload(!0)},error:function(t){return n(t)}})},t(this).magnificPopup({type:"image",closeBtnInside:!1,image:{verticalFit:!1,markup:"<div class=\"mfp-figure image-show\">\n  <div class='row'>\n    <div class='col-sm-8'>\n      <div class=\"mfp-img\"></div>\n      <div class='img-toolbar'>\n        "+(l?"<div class='btn btn-default delete-image'>Xoá ảnh</div>":void 0)+'\n      </div>\n    </div>\n    <div class="col-sm-4 img-content">\n      <div class=\'divide20\'></div>\n      <h5 class="img-show-author"><a href="/profile/'+e.username+'">'+e.full_name+'</a></h5>\n      <p class="img-show-title">'+i.photo_description+"</p>\n      <p class='img-show-counter'><a class='img-like' href='javascript:void(0)'><i class=\"fa "+(a.liked?"fa-heart":"fa-heart-o")+"\"></i></a><span class='like-count'>"+a.like_count+"</span></p>\n      <div id='comment-container-photo'>\n      </div>\n    </div>\n  </div>\n</div>",titleSrc:function(t){var e;return e=t.el.attr("title")}},callbacks:{imageLoadComplete:function(e){var n,i,l,s;return l=t(this.content).find("img.mfp-img")[0],t(this.content).parent().width(3*l.naturalWidth/2),s=t(this.content).find("a.img-like")[0],t(s).unbind("click"),t(s).click(r),i=t(this.content).find("div.delete-image")[0],i&&(t(i).unbind("click"),t(i).click(o)),n=t(this.content).find("div#comment-container-photo")[0],t(n).comments({noCommentsText:"Chưa có comment nào",profilePictureURL:"https://app.viima.com/static/media/user_profiles/user-icon.png",textareaPlaceholderText:"Để lại comment ở đây",fieldMappings:{id:"comment_id",created:"created_at",content:"comment_content",fullname:"author_name",profilePictureURL:"author_avatar"},getComments:function(e,n){return t.ajax({type:"get",url:"/photo/"+a.content_id+"/comment",success:function(t){return e(t)},error:n})},postComment:function(e,n,i){return t.ajax({type:"POST",url:"/photo/"+a.content_id+"/comment",data:e,success:function(t){return n(t)},error:i})}})}}}),n("UlibiShowImage worked!")})}})}(jQuery)}).call(this);
//# sourceMappingURL=jquery.app.js.map
