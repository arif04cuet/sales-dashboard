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
                        {{ Form::open(array('url'=>URL::route("StoreOrders"),
                        'class'=>'form-horizontal')) }}
                        <div class="form-group">
                            {{ Form::label('client', 'Client Name', array('class'=>'col-md-2 control-label')) }}
                            <div class="col-md-5">
                                {{ Form::text('client', Input::old('client'), array('class'=>'form-control',
                                'placeholder'=>'Client Name', 'required')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('sale_price', 'Sale Price', array('class'=>'col-md-2 control-label')) }}
                            <div class="col-md-5">
                                {{ Form::number('sale_price', Input::old('sale_price'), array('class'=>'form-control',
                                'placeholder'=>'Sale Price', 'required')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('product_list', 'Product List', array('class'=>'col-md-2 control-label')) }}
                            <div class="col-md-5">
                                {{ Form::select('product_list', $products, null, array('class'=>'form-control')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('amount_paid', 'Amount Paid', array('class'=>'col-md-2 control-label')) }}
                            <div class="col-md-5">
                                {{ Form::number('amount_paid', Input::old('sale_price'), array('class'=>'form-control',
                                'placeholder'=>'Amount Paid', 'required')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('due_date', 'Due Date', array('class'=>'col-md-2 control-label')) }}
                            <div class="col-md-5">
                                {{ Form::text('due_date', Input::old('due_date'), array('class'=>'form-control datepicker',
                                'placeholder'=>'Due Date', 'required')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('outstanding', 'Outstanding', array('class'=>'col-md-2 control-label')) }}
                            <div class="col-md-5">
                                {{ Form::text('outstanding', 0, array('class'=>'form-control', 'disabled')) }}
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

        $('#sale_price').keyup(function () {
            var outstanding = $('#sale_price').val() - $('#amount_paid').val();
            $('#outstanding').val(outstanding);
        });

        $('#amount_paid').keyup(function () {
            var outstanding = $('#sale_price').val() - $('#amount_paid').val();
            $('#outstanding').val(outstanding);
        });
    </script>
@stop