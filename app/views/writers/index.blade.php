@extends(Config::get('syntara::views.master'))
@section('content')
<link rel="stylesheet" type="text/css" href="/bower_components/DataTables/media/css/jquery.dataTables.css">
<script type="text/javascript" src="/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3>Writers List</h3>
        </div>
        <div class="col-md-6">
            <div style="padding-top:20px;">
                <a href="writers/create" class="btn btn-danger btn-sm pull-right"><i
                        class="glyphicon glyphicon-plus-sign"></i> Create Writers</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 writerDataTable">
            {{ Datatable::table()
            ->addColumn('ID','Name','Email','Mobile','Rate','Action') // these are the column headings to be shown
            ->setUrl(route('writers.datatable')) // this is the route where data will be retrieved
            ->render() }}
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".writerDataTable").on('click', '.remove_levels', function () {
        return confirm('Are you sure?');
    });
</script>
@stop