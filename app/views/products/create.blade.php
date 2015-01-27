@extends(Config::get('syntara::views.master'))
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br/>
            <section class="module">
                <div class="module-head"><b><strong><i class="glyphicon glyphicon-plus-sign"></i> Add New Products</strong></b></div>
                <br/>
                <div class="module-body">
                    {{ Form::open(array('url'=>URL::route('StoreProducts'), 'class'=>'form-horizontal')) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Product Name', array('class'=>'col-md-2 control-label')) }}
                        <div class="col-md-5">
                            {{ Form::text('name', Input::old('name'), array('class'=>'form-control', 'placeholder'=>'Product Name', 'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('price', 'Price', array('class'=>'col-md-2 control-label')) }}
                        <div class="col-md-5">
                            {{ Form::text('price', Input::old('price'), array('class'=>'form-control', 'placeholder'=>'Price', 'required')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-5">
                            <button class="btn btn-danger btn-sm" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </section>
        </div>
    </div>
</div>
@stop