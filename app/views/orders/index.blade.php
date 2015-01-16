@extends(Config::get('syntara::views.master'))
@section('content')
<link rel="stylesheet" type="text/css" href="/bower_components/DataTables/media/css/jquery.dataTables.css">
<script type="text/javascript" src="/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
<div class="container">
    {{ Datatable::table()
    ->addColumn('id','Name') // these are the column headings to be shown
    ->setUrl(route('orders.datatable')) // this is the route where data will be retrieved
    ->render() }}
</div>
@stop