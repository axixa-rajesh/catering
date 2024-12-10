<?php
$data = DB('menu')->all();
if(isset($_POST['del'])){
    $delid=implode(",",$_POST['del']);
    DB('menu')->delete($delid);
    Session::set('gt',"Deleted Successfully!");
    redirect('menu');
    exit;
}
?>
<div class="mt-4">
    <a href="<?=ROOT;?>menu/form" class="btn btn-primary">Add Items</a>
</div>
<?php if($msg=Session::get('gt')){
    ?>
    <div class="alert alert-success text-center h3"><?=$msg;?></div>
    <?php
    Session::delete('gt');
}
?>
<form method="post">
    <table class="table table-stripted border" id="list">
        <thead class="table-dark">
            <tr>
                <th>S.No</th>
                <th> <input type="checkbox" id="all" onclick="checkdel(this)"> <label for="all">All</label> </th>
                <th>Item Name</th>
                <th>Categories</th>
                <th>Status</th>
                <th>Item Inserted </th>
                <th>Item Updated</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $index = 0;
            foreach ($data as $info) { ?>
                <tr>
                    <td><?= ++$index; ?></td>
                    <td><input type="checkbox" onclick="displaybtn()" name="del[]" class="delc" value="<?= $info['id']; ?>"> </td>
                    <td>
                        <a href="<?=ROOT;?>menu/form/<?=$info['id'];?>" title="Click for edit">
                        <?= $info['item']; ?>
                        </a>
                    </td>
                    <td><?= $info['category']; ?></td>
                    <td><?= $info['status']; ?></td>
                    <td><?= date('d-M-Y h:i A', strtotime($info['created_at'])); ?></td>
                    <td><?= date('d-M-Y h:i A', strtotime($info['updated_at'])); ?></td>
                </tr>

            <?php } ?>
        </tbody>
    </table>
    <div id="ditem" style="display: none;">
        <button class="btn btn-danger" onclick="return confirm('Do you really want to delete these items?')">Delete Selected Item(s)</button>

    </div>
</form>