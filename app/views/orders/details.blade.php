@extends(Config::get('syntara::views.master'))
@section('content')
    <br/>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section class="module">
                    <div class="module-head">
                        <b><strong>Order Information</strong></b>
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
                                <td><label>Percent</label></td>
                                <td>{{ $orders->percent }}</td>
                                <td><label>Status</label></td>
                                <td>{{ $orders->status }}</td>
                            </tr>
                            <tr>
                                <td><label>Fee</label></td>
                                <td>{{ $orders->fee }}</td>
                                <td><label>Sale Price</label></td>
                                <td>{{ $orders->sale_price }}</td>
                            </tr>
                            <tr>
                                <td><label>No of Page</label></td>
                                <td>{{ $orders->no_of_page }}</td>
                                <td><label>Amount Paid</label></td>
                                <td>{{ $orders->amount_paid }}</td>
                            </tr>
                            <tr>
                                <td><label>Profit</label></td>
                                <td>{{ $orders->profit }}</td>
                                <td><label>Outstanding</label></td>
                                <td>{{ $orders->outstanding }}</td>
                            </tr>
                            <tr>
                                <td><label>Instruction</label></td>
                                <td>{{ $orders->instructions }}</td>
                                <td><label>Created Date</label></td>
                                <td><?php echo date('d M Y h:i:s A', strtotime(str_replace('-', '/', $orders->created_at))); ?></td>
                            </tr>
                            <tr>
                                <td><label>Course Outline</label></td>
                                <td>{{ $orders->course_outline }}</td>
                                <td><label>Updated Date</label></td>
                                <td><?php echo date('d M Y h:i:s A', strtotime(str_replace('-', '/', $orders->updated_at))); ?></td>
                            </tr>
                            <tr>
                                <td><label>Lecture Notes</label></td>
                                <td>{{ $orders->lecture_notes }}</td>
                                <td><label></label></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><label>Additional Materials</label></td>
                                <td>{{ $orders->additional_materials }}</td>
                                <td><label></label></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <section class="module">
                    <div class="module-head">
                        <b><strong>Assign Writer</strong></b>
                    </div>
                    <div class="module-body" style="padding: 5">
                        <?php if(!is_null($orders->writer)): ?>
                        <table id="orders-details" class="table table-condensed table-responsive">
                            <tbody>
                            <tr>
                                <td><label>Writer Name</label></td>
                                <td><label>Status</label></td>
                                <td><label>Date</label></td>
                            </tr>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <table id="orders-details" class="table table-condensed table-responsive">
                            <tbody>
                            <tr>
                                <td>No writer assign</td>
                            </tr>
                            </tbody>
                        </table>
                        <?php endif; ?>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <section class="module">
                    <div class="module-head">
                        <b><strong>Order Assign</strong></b>
                    </div>
                    <div class="module-body" style="padding: 5">
                        {{ Form::open(array('url'=>URL::route("assignWriterQc",$orders->id), 'class'=>'form-horizontal','id'=>'assignUser')) }}
                        <div class="form-group">
                            <div class="col-md-3">
                                {{ Form::label('type', 'Type') }}
                                {{ Form::select('type', $type, null, array('class'=>'form-control')) }}
                            </div>
                            <div class="col-md-3">
                                {{ Form::label('user', 'User') }}
                                {{ Form::select('user[]', array(''), null, array('id'=>'user','class'=>'form-control',
                                'multiple')) }}
                            </div>
                            <div class="col-md-4">
                                {{ Form::label('comment', 'Comment') }}
                                {{ Form::textarea('comment', null, array('class'=>'form-control', 'rows'=>'2', 'cols'=>'10')) }}
                            </div>
                            <div class="col-md-2">
                                {{ Form::label('save', '&nbsp;') }}
                                <button class="btn btn-danger form-control" id="assign-btn" type="submit"><i
                                            class="glyphicon glyphicon-ok-sign"></i> Send
                                </button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </section>
            </div>
        </div>
    </div>
    <style>
        #orders-details {
            margin-bottom: 0;
        }

        #orders-details tbody tr td {
            border-top: 0;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {

            function setUser() {
                $.ajax({
                    type: "GET",
                    url: "{{route('writerQcList')}}",
                    data: {
                        type: $('#type').val()
                    },
                    success: function (data) {
                        $("#user").html('');
                        $.each(data, function (id, user) {
                            option = "<option value=" + id + ">" + user + "</option>"
                            $("#user").append(option);
                        });
                    }
                });
            }

            setUser();

            $('#type').change(function () {
                setUser();
            });

            $('#assign-btn').click(function () {
                $.ajax({
                    type: "GET",
                    url: "{{route('assignWriterQc',$orders->id)}}",
                    data: {
                        type: $('#type').val(),
                        user: $('#user').val(),
                        comment: $('#comment').val()
                    },
                    success: function (data) {
                        alert(JSON.stringify(data));
                    }
                });
            });

            //assign user by ajax
            $('#assign-btn').click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "<?php echo URL::route('assignWriterQc',array('id'=>$orders->id))?>",
                    data: $('#assignUser').serialize(),
                    success: function (data) {
                        alert(JSON.stringify(data));
                    }
                });
            });
        });
    </script>
@stop