{!! Form::model($profile, array(
    'route'     => array('profile.update', $profile->username),
    'method'    => 'PUT',
    'id'        => 'sky-form',
    'class'     => 'sky-form sky-form-columns'
     )) !!}
{!! Form::token() !!}

<div class="tabs-container">
    <ul class="nav nav-tabs">
        <li>
            <a data-toggle="tab" href="#tab-0">
                <span class="fa fa-2x fa-pencil"></span>
            </a>
        </li>
        <li class="active">
            <a data-toggle="tab" href="#tab-1">
                <span class="fa fa-2x fa-user"></span>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="tab-0" class="tab-pane">
            <div>
                <fieldset>
                    <section>
                        <label class="label">Vài dòng giới thiệu ngắn để công đồng Ulibier hiểu bạn nhiều hơn</label>
                        <label class="textarea">

                            {!! Form::textarea('aboutme_description',null,[ "row" => "4", "style" => "height: 200px" ]) !!}

                        </label>
                    </section>
                    <section>
                        <label class="label">Câu nói ưa thích của bạn :)</label>
                        <label class="input">

                            {!! Form::text('aboutme_quotes',null) !!}

                        </label>
                    </section>
                </fieldset>
            </div>
        </div>
        <div id="tab-1" class="tab-pane active">
            <div>
                <fieldset>
                    <div class="row">
                        <label class="label col col-3">Giới tính của bạn</label>
                        <section class="inline-group col col-9">
                            <label class="radio">

                                {!! Form::radio('sex', 'male') !!}
                                <i></i>Nam

                            </label>
                            <label class="radio">

                                {!! Form::radio('sex', 'female') !!}
                                <i></i>Nữ

                            </label>
                        </section>
                    </div>
                    <div class="divide20"></div>
                    <div class="row">
                        <label class="label col col-3">Sinh nhật</label>
                        <div class="col col-9 datepicker">

                            {!! Form::hidden('birthday') !!}

                            <div class="row">
                                <section class="col col-4">
                                    <label class="select">

                                        {!! Form::selectRange('_birthday-date', 01, 31) !!}
                                        <i></i>

                                    </label>
                                </section>
                                <section class="col col-4">
                                    <label class="select">

                                        {!! Form::selectMonth('_birthday-month') !!}
                                        <i></i>

                                    </label>
                                </section>
                                <section class="col col-4">
                                    <label class="select">

                                        {!! Form::selectYear('_birthday-year', 1900, 2015) !!}
                                        <i></i>

                                    </label>
                                </section>
                            </div>
                        </div>
                        <script>
                            Number.prototype.pad = function(size) {
                                var s = String(this);
                                while (s.length < (size || 2)) {s = "0" + s;}
                                return s;
                            };
                            var datepicker=document.getElementsByClassName("datepicker")[0];
                            var input=datepicker.querySelector("[type='hidden']");
                            var inputDate=datepicker.querySelector("[name='_birthday-date']");
                            var inputMonth=datepicker.querySelector("[name='_birthday-month']");
                            var inputYear=datepicker.querySelector("[name='_birthday-year']");
                            function dateChange() {
                                var date = inputDate.options[inputDate.selectedIndex].value;
                                var month = inputMonth.options[inputMonth.selectedIndex].value;
                                var year = inputYear.options[inputYear.selectedIndex].value;
                                var d = new Date(year, month, date);
                                input.value = d.getFullYear() + "-" + d.getMonth().pad(2) + "-" + d.getDate().pad(2);
                            }
                            function parseDate() {
                                if (input.value.length==0) return;
                                var d = new Date(Date.parse(input.value));
                                inputDate.value = d.getDate();
                                inputMonth.value = d.getMonth();
                                inputYear.value = d.getFullYear();
                            }
                            parseDate();
                            inputDate.onchange=dateChange;
                            inputMonth.onchange=dateChange;
                            inputYear.onchange=dateChange;
                        </script>
                    </div>
                    <div class="row">
                        <label class="label col col-3">Bạn đang ở đâu?</label>
                        <section class="col col-9">
                            <label class="input">

                                {!! Form::text('basicinfo_currentPlace') !!}

                            </label>
                        </section>
                    </div>
                    <div class="row">
                        <label class="label col col-3">Nghề nghiệp hiện tại</label>
                        <section class="col col-9">
                            <label class="input">

                                {!! Form::text('basicinfo_job') !!}

                            </label>
                        </section>
                    </div>
                    <div class="row">
                        <label class="label col col-3">Sở thích</label>
                        <section class="col col-9">
                            <label class="input">

                                {!! Form::text('basicinfo_hobbies') !!}

                            </label>
                        </section>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="tab-content-footer">

            {!! Form::submit("Lưu lại", [ "class" => "btn btn-primary" ]) !!}

        </div>
    </div>
</div>

{!! Form::close() !!}