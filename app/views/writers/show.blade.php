@extends(Config::get('syntara::views.master'))
@section('content')
<br />
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <section class="module">
                <div class="module-head">
                    <b>Showing {{ $writers->name }}</b>
                </div>
                <div class="module-body">
                    <div class="row">
                        <div class="col-md-2"><label>ID</label></div>
                        <div class="col-md-4"><p>{{ $writers->id }}</p></div>
                        <div class="col-md-2"><label>Name</label></div>
                        <div class="col-md-4"><p>{{ $writers->name }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><label>Email</label></div>
                        <div class="col-md-4"><p>{{ $writers->email }}</p></div>
                        <div class="col-md-2"><label>Mobile</label></div>
                        <div class="col-md-4"><p>{{ $writers->mobile }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><label>Rate</label></div>
                        <div class="col-md-4"><p>{{ $writers->rate }}</p></div>
                        <div class="col-md-2"><label>Joining Date</label></div>
                        <div class="col-md-4"><p>{{ $writers->created_at }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><label>Modified Date</label></div>
                        <div class="col-md-4"><p>{{ $writers->updated_at }}</p></div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="pull-left btn-margin">
                                <a href="{{ URL::to(Config::get('syntara::config.uri').'/writers/'.$writers->id.'/edit') }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                            </div>
                            <div class="pull-left">
                                {{ Form::open(array('url'=>Config::get("syntara::config.uri").'/writers/'.$writers->id)) }}
                                {{ Form::hidden('_method','DELETE') }}
                                <button class="btn btn-danger btn-sm" type="submit"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div> -->
                </div>
            </section>
        </div>
    </div>
</div>
@stop