<h3>Hello Admin</h3>
<?php echo $subject ?>
<p>You can check order here <a href="<?php echo URL::route('DetailsOrders', array('id' => $orderId))?>"
                               title="View Order">View
        Order</a></p>