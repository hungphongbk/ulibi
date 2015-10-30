<div class="tabs-container">
    <ul class="nav nav-tabs">
        <li>
            <a data-toggle="tab" href="#tab-1" aria-expanded="false">Upload ảnh</a>
        </li>
        <li class="active"><a data-toggle="tab" href="#tab-2" aria-expanded="true">Hoặc chọn một ảnh từ kho ảnh của bạn</a></li>
    </ul>
    <div class="tab-content">
        <div id="tab-1" class="tab-pane">

            <strong>Lorem ipsum dolor sit amet, consectetuer adipiscing</strong>

            <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of
                existence in this spot, which was created for the bliss of souls like mine.</p>

            <p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at
                the present moment; and yet I feel that I never was a greater artist than now. When.</p>
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