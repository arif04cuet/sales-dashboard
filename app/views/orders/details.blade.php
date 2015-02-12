@extends(Config::get('syntara::views.master'))
@section('content')
    <br/>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section class="module">
                    <div class="module-head">
                        <b><strong>Order Details</strong></b>
                    </div>
                    <div class="module-body" style="padding: 5px">
                        <div id="orderDetails">
                            <ul class="list-inline">
                                <?php foreach($orderFields as $field):?>
                                <li class="col-md-2"><label for=""><?php echo str_replace('_', ' ', strtoupper($field))?></label>
                                    : <?php echo $orders->{$field}?></li>
                                <?php endforeach;?>
                                    <br style="clear: both"/>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <section class="module">
                    <div class="module-head">
                        <b><strong>Invitations</strong></b>
                    </div>
                    <div class="module-body" style="padding: 5px">

                        <div id="invitations">

                        </div>

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
                    <div class="module-body" style="padding: 5px">
                        {{ Form::open(array('url'=>URL::route("assignWriterQc",$orders->id), 'class'=>'form-horizontal','id'=>'assignUser')) }}
                        <div class="form-group">
                            <div class="col-md-3">
                                {{ Form::label('type', 'Type') }}
                                {{ Form::select('type', $type, null, array('class'=>'form-control')) }}
                            </div>
                            <div class="col-md-3">
                                {{ Form::label('user', 'User') }}
                                {{ Form::select('user', array(''), null, array('id'=>'user','class'=>'form-control')) }}
                            </div>
                            <div class="col-md-4">
                                {{ Form::label('comment', 'Comment') }}
                                {{ Form::textarea('comment', null, array('class'=>'form-control', 'rows'=>'2', 'cols'=>'10')) }}
                            </div>
                            <div class="col-md-2">
                                <button style="margin-top: 25px" class="btn btn-danger" id="assign-btn" type="submit"><i
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
                        var $select = $('#user');
                        $select.find('option').remove();
                        $.each(data, function (key, value) {
                            $select.append('<option value=' + key + '>' + value + '</option>');
                        });

                    }
                });
            }

            $('#type').change(function () {
                setUser();
            });

            //assign user by ajax
            $('#assign-btn').click(function (e) {
                e.preventDefault();
                var $button = $(this);
                $button.text('Working..').prop("disabled", true);
                $.ajax({
                    type: "POST",
                    url: "<?php echo URL::route('assignWriterQc',array('id'=>$orders->id))?>",
                    data: $('#assignUser').serialize(),
                    success: function (data) {
                        loadInvitation('invitations');
                        $button.text('Send').prop("disabled", false);
                        $('#assignUser')[0].reset();
                        alert('Invitation has been sent successfully')
                    }
                });
            });

            //delete invitation
            $(document).on('click', '#del-invitation', function (e) {
                e.preventDefault();
                var $row = $(this).parent().parent();
                var $url = $(this).attr('href');

                $.ajax({
                    type: "POST",
                    url: $url,
                    success: function (data) {
                        if (data == '1') {
                            $row.remove();
                            alert('Invitation has been deleted');
                        }
                        else
                            alert('an error occured');
                    }
                });
            });

            //Load Invitations by ajax
            loadInvitation('invitations');
            function loadInvitation($id) {
                $('.ajax-loader').show();
                $.ajax({
                    type: "GET",
                    url: "<?php echo URL::route('orderInvitations',array('id'=>$orders->id))?>",
                    success: function (data) {
                        $('#' + $id).empty().html(data);
                        $('.ajax-loader').hide();
                    }
                });
            }

        });
    </script>
@stop