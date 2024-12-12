<?php
$data = DB('menu')->all();

?>

<form method="post">
    <table class="table table-stripted border" id="list">
        <thead class="table-dark">
            <tr>
                <th>S.No</th>
                <th>Item Name</th>
                <th>Categories</th>
                <th>Description</th>
             
            </tr>
        </thead>
        <tbody>
            <?php
            $index = 0;
            foreach ($data as $info) { ?>
                <tr>
                    <td><?= ++$index; ?></td>
                    <td>
                       
                            <?= $info['item']; ?>
                      
                    </td>
                    <td><?= $info['category']; ?></td>
                    <td><?= $info['description']; ?></td>
                 
                </tr>

            <?php } ?>
        </tbody>
    </table>
    <div id="ditem" style="display: none;">
        <button class="btn btn-danger" onclick="return confirm('Do you really want to delete these items?')">Delete Selected Item(s)</button>

    </div>
</form>