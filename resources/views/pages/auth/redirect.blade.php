{!! Form::open(array('id'=>'form','method'=>$form['method'],'url'=>url('/').$form['action'])) !!}
    @foreach($form['fields'] as $field => $value)
        {!! Form::hidden($field,$value) !!}
    @endforeach
<script>
    document.forms[0].submit();
</script>
{!! Form::close() !!}