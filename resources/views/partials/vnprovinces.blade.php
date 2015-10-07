<?php
$vnprovinces=[
    'Bac Giang','Bac Kan',
    'Cao Bang','Ha Giang',
    'Lang Son','Phu Tho'
]
?>
@foreach($vnprovinces as $p)
<option value="{{$p}}">{{$p}}</option>
@endforeach