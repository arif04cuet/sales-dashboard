@extends(Config::get('syntara::views.master'))
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/DataTables/media/css/jquery.dataTables.css') }}">
<script type="text/javascript" src="{{ asset('/bower_components/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-right">
            <div style="padding:20px 0;">
                <a href="qc/create" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-plus-sign"></i> Add New</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 writerDataTable">
            <section class="module">
                <div class="module-head"><b><strong><i class="glyphicon glyphicon-user"></i> All Quality Controllers</strong></b></div>
                <div class="module-body">
                    {{ Datatable::table()
                    ->addColumn('ID','Name','Email','Mobile','Rate','Action') // these are the column headings to be shown
                    ->setUrl(route('qc.datatable')) // this is the route where data will be retrieved
                    ->render() }}
                </div>
            </section>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".writerDataTable").on('click', '.remove_levels', function () {
        return confirm('Are you sure?');
    });
</script>
@stop