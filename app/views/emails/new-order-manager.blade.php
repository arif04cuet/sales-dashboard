<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body style="color: #333; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; line-height: 1.42857;">
<div style="margin-left: auto; margin-right: auto; padding-left: 15px; padding-right: 15px; margin-top: 10px;">
    <h3>Order has been placed!</h3>
    <br/>
    <div style="border: 1px solid #d2d4d8; border-radius: 3px; margin-bottom: 15px;">
        <div style="background: none repeat scroll 0 0 #f7f8f9; border-bottom: 1px solid #d9d9dd; border-radius: 2px 2px 0 0; height: 40px;">
            <span style="color: #727476; display: inline-block; font-weight: 500; padding: 10px 15px;"><strong>Order Information</strong></span>
        </div>
        <div style="background: none repeat scroll 0 0 #fff; border-radius: 0 0 2px 2px; padding: 10px;">
            <table style="width:100%; border-collapse: collapse; color: #5E6B72;">
                <tr>
                    <td style="padding: 5px;"><strong>Client</strong></td>
                    <td style="padding: 5px;">{{$client}}</td>
                    <td style="padding: 5px;"><strong>Order Date</strong></td>
                    <td style="padding: 5px;">{{$order_date}}</td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><strong>Sale Price</strong></td>
                    <td style="padding: 5px;">{{$sale_price}}</td>
                    <td style="padding: 5px;"><strong>Due Date</strong></td>
                    <td style="padding: 5px;">{{$due_date}}</td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><strong>Amount Paid</strong></td>
                    <td style="padding: 5px;">{{$amount_paid}}</td>
                    <td style="padding: 5px;"><strong>Status</strong></td>
                    <td style="padding: 5px;">{{$status}}</td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><strong>Outstanding</strong></td>
                    <td style="padding: 5px;">{{$outstanding}}</td>
                    <td style="padding: 5px;"><strong></strong></td>
                    <td style="padding: 5px;"></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div style="margin-left: auto; margin-right: auto; padding-left: 15px; padding-right: 15px; margin-top: 10px;">
    <div style="border: 1px solid #d2d4d8; border-radius: 3px; margin-bottom: 15px;">
        <div style="background: none repeat scroll 0 0 #f7f8f9; border-bottom: 1px solid #d9d9dd; border-radius: 2px 2px 0 0; height: 40px;">
            <span style="color: #727476; display: inline-block; font-weight: 500; padding: 10px 15px;"><strong>User</strong></span>
        </div>
        <div style="background: none repeat scroll 0 0 #fff; border-radius: 0 0 2px 2px; padding: 10px;">
            <table style="width:100%; border-collapse: collapse; color: #5E6B72;">
                <tr>
                    <td style="padding: 5px;"><strong>Name</strong></td>
                    <td style="padding: 5px;">{{$username}}</td>
                    <td style="padding: 5px;"><strong>Email</strong></td>
                    <td style="padding: 5px;">{{$email}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>
