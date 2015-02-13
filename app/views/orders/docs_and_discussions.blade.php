<?php if($order->documents->count()):?>
<table id="orders-documents" class="table table-condensed table-responsive table-bordered">
    <tbody>
    <tr>
        <td><label>User</label></td>
        <td><label>Comments</label></td>
        <td><label>Date</label></td>
        <td><label>Docs</label></td>
    </tr>
    <?php foreach($order->documents as $doc):?>
    <tr>
        <td><?php echo $doc->user->first_name . ' ' . $doc->user->last_name?></td>
        <td><?php echo $doc->comment;?></td>
        <td><?php echo $doc->created_at;?></td>
        <td><a target="_blank" href="<?php $pdfLink = 'upload/' . $doc->file_name;echo URL::asset($pdfLink)?>">Download</a></td>
    </tr>
    <?php endforeach; ?>

    </tbody>
</table>
<?php else: ?>
<p>No doc and discussion founds</p>
<?php endif; ?>

