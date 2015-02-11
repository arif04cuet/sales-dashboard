<table id="orders-invitation" class="table table-condensed table-responsive table-bordered">
    <tbody>
    <tr>
        <td><label>Name</label></td>
        <td><label>Type</label></td>
        <td><label>Status</label></td>
        <td><label>Date</label></td>
        <td><label>Action</label></td>
    </tr>
    <?php foreach($order->invitaions as $invitation):?>
    <tr>
        <td><?php echo $invitation->user->first_name . ' ' . $invitation->user->last_name?></td>
        <td><label>Type</label></td>
        <td><?php echo $invitation->getStatus();?></td>
        <td><?php echo $invitation->created_at;?></td>
        <td>
            <a id="del-invitation"
               href="">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>

    </tbody>
</table>