@extends(Config::get('syntara::views.master'))
@section('content')
<br />
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <section class="module">
                <div class="module-head">
                    <b><strong><i class="glyphicon glyphicon-eye-open"></i> Showing {{ $qc->name }}</strong></b>
                </div>
                <div class="module-body">
                    <div class="row">
                        <div class="col-md-2"><label>ID</label></div>
                        <div class="col-md-4"><p>{{ $qc->id }}</p></div>
                        <div class="col-md-2"><label>Name</label></div>
                        <div class="col-md-4"><p>{{ $qc->name }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><label>Email</label></div>
                        <div class="col-md-4"><p>{{ $qc->email }}</p></div>
                        <div class="col-md-2"><label>Mobile</label></div>
                        <div class="col-md-4"><p>{{ $qc->mobile }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><label>Rate</label></div>
                        <div class="col-md-4"><p>{{ $qc->rate }}</p></div>
                        <div class="col-md-2"><label>Joining Date</label></div>
                        <div class="col-md-4"><p>{{ $qc->created_at }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><label>Modified Date</label></div>
                        <div class="col-md-4"><p>{{ $qc->updated_at }}</p></div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@stop