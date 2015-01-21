@extends(Config::get('syntara::views.master'))
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br/>
            <section class="module">
                <div class="module-head"><b><strong><i class="glyphicon glyphicon-plus-sign"></i> Create an
                            Order</strong></b></div>
                <br/>

                <div class="module-body">
                    {{ Form::open(array('url'=>Config::get("syntara::config.uri").'/orders',
                    'class'=>'form-horizontal')) }}
                    <div class="form-group">
                        {{ Form::label('order_date', 'Order Date', array('class'=>'col-md-2 control-label')) }}
                        <div class="col-md-2">
                            {{ Form::input('datetime', 'order_date', Input::old('order_date'),
                            array('class'=>'form-control datepicker', 'placeholder'=>'Order Date', 'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('client', 'Client Name', array('class'=>'col-md-2 control-label')) }}
                        <div class="col-md-5">
                            {{ Form::text('client', Input::old('client'), array('class'=>'form-control',
                            'placeholder'=>'Client Name', 'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('fee', 'Fee', array('class'=>'col-md-2 control-label')) }}
                        <div class="col-md-5">
                            {{ Form::text('fee', Input::old('fee'), array('class'=>'form-control',
                            'placeholder'=>'Fee', 'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-5">
                            <button class="btn btn-danger btn-sm" type="submit"><i
                                    class="glyphicon glyphicon-ok-sign"></i> Save
                            </button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </section>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        todayBtn: "linked",
        todayHighlight: true
    });
</script>
@stop