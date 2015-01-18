@extends(Config::get('syntara::views.master'))
@section('content')
    <div class="container">
        <h1>Add Quality Controller</h1>

        <!-- if there are creation errors, they will show here -->
        {{ HTML::ul($errors->all()) }}

        {{ Form::open(array('url' => Config::get('syntara::config.uri').'/qc')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('mobile', 'Mobile') }}
            {{ Form::text('mobile', Input::old('mobile'), array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('rate', 'Rate') }}
            {{ Form::text('rate', Input::old('rate'), array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div>
@stop