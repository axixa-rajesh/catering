<?php
mustlogin();
$dbobj = DB('customer');
$data = $dbobj->all();
if (isset($_POST['del'])) {
    $delid = implode(",", $_POST['del']);
    $dbobj->delete($delid);
    Session::set('gt', "Deleted Successfully!");
    redirect('booking');
    exit;
}
?>
<div class="mt-4">
    <a href="<?= ROOT; ?>booking/form" class="btn btn-primary">New Order</a>
</div>
<?php if ($msg = Session::get('gt')) {
?>
    <div class="alert alert-success text-center h3"><?= $msg; ?></div>
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
                <th>View</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Booking Date</th>
                <th>Place</th>
                <th>Purpose </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $index = 0;
            foreach ($data as $info) { ?>
                <tr>
                    <td><?= ++$index; ?></td>
                    <td><input type="checkbox" onclick="displaybtn()" name="del[]" class="delc" value="<?= $info['id']; ?>">

                    </td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#loaddata<?= $info['id']; ?>">
                            View Order

                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="loaddata<?= $info['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel"><?=$info['name']?> Slip Details</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="min-width:100%;">

                                        <?php
                                        $cid = $info['id'];
                                        include("modules/booking/slip.php"); ?>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="<?= ROOT; ?>booking/form/<?= $info['id']; ?>" title="Click for edit">
                            <?= $info['name']; ?>
                        </a>
                    </td>

                    <td><?= $info['mobile']; ?></td>
                    <td><?= $info['dateofevent'] ? date('d - M (Y)', strtotime($info['dateofevent'])) : "<span class='text-muted'>N/A</span>"; ?></td>
                    <td><?= $info['place']; ?></td>
                    <td><?= $info['purposes']; ?></td>
                </tr>

            <?php } ?>
        </tbody>
    </table>
    <div id="ditem" style="display: none;">
        <button class="btn btn-danger" onclick="return confirm('Do you really want to delete these items?')">Delete Selected Item(s)</button>

    </div>
</form>