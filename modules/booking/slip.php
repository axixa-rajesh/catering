<?php
$sql = "select * from slip where customer_id='$cid'";
$idata = DB('slip')->custom($sql);
?>
    <table class="table border tbl-striped">
        <thead class="table-primary">
            <tr>
                <th>S.No.</th>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Price For You</th>
                <th>Discount</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $index = 0;
            $mtotal=0;
            foreach ($idata as $iinfo) { ?>
                <tr>
                    <td><?= ++$index ?></td>
                    <td><?= $iinfo['item']; ?></td>
                    <td><?= $iinfo['price_per_unit']; ?></td>
                    <td><?= $iinfo['qty']; ?></td>
                    <td><?= $iinfo['after_discount_price_per_unit']; ?></td>
                    <td><?= $iinfo['discount_per_unit']; ?></td>
                    <td><?php
                    echo $iinfo['total']; 
                    $mtotal+=
                        $iinfo['total'];
                    ?></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
    <h4>Final Amount to Pay:<span class="text-primary"> <?=$mtotal;?></span> ₹ </h4>
