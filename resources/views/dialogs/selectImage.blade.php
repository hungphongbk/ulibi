<div class="tabs-container">
    <ul class="nav nav-tabs">
        <li>
            <a data-toggle="tab" href="#tab-1" aria-expanded="false">Upload ảnh</a>
        </li>
        <li class="active"><a data-toggle="tab" href="#tab-2" aria-expanded="true">Hoặc chọn một ảnh từ kho ảnh của bạn</a></li>
    </ul>
    <div class="tab-content">
        <div id="tab-1" class="tab-pane">
            <div id="uploadImageFromPC" class="drag-drop-animation" style="background-image: url(data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==); height: 100%;">
                <div style="width: 60%; margin-left: 20%; text-align: center; padding-top: 2em; padding-bottom: 1em;">
                    <i class="fa fa-3x fa-camera" style="margin-right: 0.3em;margin-bottom: 0.3em;"></i>
                    <p style="font-size: 16px; line-height: 2em;">
                        Kéo thả ảnh từ máy tính vào đây để tạo một bức cover đẹp cho bài viết bạn nhé ^^
                    </p>
                </div>
            </div>
        </div>
        <div id="tab-2" class="tab-pane active">
            <div style="height: 360px; overflow-y: scroll; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 15px; padding-bottom: 15px; padding-left: 15px; padding-right: 15px;">
                <div class="row" id="selectFromExistingImages">
                    @foreach($ulibier->photos as $p)
                        <div class="col-sm-4 col-md-3 col-lg-2 selectable" style="margin-top: 15px;" data-photoId="{{ $p->photo_id }}">
                            <div class="ratio-500-333 background" style="background-image: url('{{ $p->src }}')">
                                <span class="fa fa-2x fa-check-circle selectable-mark"></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <a href="" data-role="change" class="btn btn-theme-bg btn-sm">Chọn hình này</a>
        </div>
    </div>
</div>