@extends(Config::get('syntara::views.master'))
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Edit {{ $writers->name }}</h3>
            {{ Form::model($writers, array('url'=>Config::get("syntara::config.uri").'/writers/'.$writers->id, 'class'=>'form-horizontal', 'method'=>'PUT')) }}
            <div class="form-group">
                {{ Form::label('name', 'Name', array('class'=>'col-md-2 control-label')) }}
                <div class="col-md-5">
                    {{ Form::text('name', Input::old('name'), array('class'=>'form-control', 'placeholder'=>'Name', 'required')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('email', 'Email', array('class'=>'col-md-2 control-label')) }}
                <div class="col-md-5">
                    {{ Form::email('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>'Email', 'required')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('mobile', 'Mobile', array('class'=>'col-md-2 control-label')) }}
                <div class="col-md-5">
                    {{ Form::text('mobile', Input::old('mobile'), array('class'=>'form-control', 'placeholder'=>'Mobile', 'required')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('rate', 'Rate', array('class'=>'col-md-2 control-label')) }}
                <div class="col-md-5">
                    {{ Form::text('rate', Input::old('rate'), array('class'=>'form-control', 'placeholder'=>'Rate', 'required')) }}
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-5">
                    <button class="btn btn-danger btn-sm" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Update Writer</button>
                </div>
            </div>
            {{ Form::close() }}

        </div>
    </div>
</div>
@stop