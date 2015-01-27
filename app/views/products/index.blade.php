@extends(Config::get('syntara::views.master'))
@section('content')
<link rel="stylesheet" type="text/css" href="/bower_components/DataTables/media/css/jquery.dataTables.css"
      xmlns="http://www.w3.org/1999/html">
<script type="text/javascript" src="/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-right">
            <div style="padding:20px 0;">
                <a href={{URL::route('CreateProducts')}} class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-plus-sign"></i> Add New</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 productDataTable">
            <section class="module">
                <div class="module-head"><b><strong><i class="glyphicon glyphicon-user"></i> All Products</strong></b></div>
                <div class="module-body">
                    {{ Datatable::table()
                    ->addColumn('ID','Name','Price', 'Action') // these are the column headings to be shown
                    ->setUrl(route('products.datatable')) // this is the route where data will be retrieved
                    ->render() }}
                </div>
            </section>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".productDataTable").on('click', '.remove_levels', function () {
        return confirm('Are you sure?');
    });
</script>
@stop