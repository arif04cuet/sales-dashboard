@extends(Config::get('syntara::views.master'))
@section('content')
<br />
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <section class="module">
                <div class="module-head">
                    <b><strong>Order #{{ $orders->id }}</strong></b>
                </div>
                <div class="module-body" style="padding: 5">
                    <table id="orders-details" class="table table-condensed table-responsive">
                        <tbody>
                            <tr>
                                <td><label>Order Id</label></td>
                                <td>{{ $orders->id }}</td>
                                <td><label>Order Date</label></td>
                                <td><?php echo date('d M Y h:i:s A', strtotime(str_replace('-', '/', $orders->order_date))); ?></td>
                            </tr>
                            <tr>
                                <td><label>Client</label></td>
                                <td>{{ $orders->client }}</td>
                                <td><label>Due Date</label></td>
                                <td><?php echo date('d M Y h:i:s A', strtotime(str_replace('-', '/', $orders->due_date))); ?></td>
                            </tr>
                            <tr>
                                <td><label>Salesman</label></td>
                                <td>{{ $orders->salesman_id }}</td>
                                <td><label>Status</label></td>
                                <td>{{ $orders->status }}</td>
                            </tr>
                            <tr>
                                <td><label>Writer</label></td>
                                <td>{{ $orders->writer_id }}</td>
                                <td><label>Sale Price</label></td>
                                <td>{{ $orders->sale_price }}</td>
                            </tr>
                            <tr>
                                <td><label>QC</label></td>
                                <td>{{ $orders->qc_id }}</td>
                                <td><label>Amount Paid</label></td>
                                <td>{{ $orders->amount_paid }}</td>
                            </tr>
                            <tr>
                                <td><label>Percent</label></td>
                                <td>{{ $orders->percent }}</td>
                                <td><label>Outstanding</label></td>
                                <td>{{ $orders->outstanding }}</td>
                            </tr>
                            <tr>
                                <td><label>Fee</label></td>
                                <td>{{ $orders->fee }}</td>
                                <td><label>Created Date</label></td>
                                <td><?php echo date('d M Y h:i:s A', strtotime(str_replace('-', '/', $orders->created_at))); ?></td>
                            </tr>
                            <tr>
                                <td><label>No of Page</label></td>
                                <td>{{ $orders->no_of_page }}</td>
                                <td><label>Updated Date</label></td>
                                <td><?php echo date('d M Y h:i:s A', strtotime(str_replace('-', '/', $orders->updated_at))); ?></td>
                            </tr>
                            <tr>
                                <td><label>Profit</label></td>
                                <td>{{ $orders->profit }}</td>
                                <td><label></label></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>
<style>
    #orders-details{margin-bottom: 0;}
    #orders-details tbody tr td{border-top:0;}
</style>
@stop