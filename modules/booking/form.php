    <?php
    $allitems = DB('menu')->all('id,item');
    if (isset($_POST['name'])) {
        $custdata = [
            'name' => $_POST['name'],
            'mobile' => $_POST['mobile'],
            'purposes' => $_POST['purpose'],
            'place' => $_POST['place'],
            'dateofevent' => $_POST['dateofevent'],
        ];
        $cid = DB('customer')->save($custdata);
        if ($cid > 0) {
            $obj = DB('slip');
            $count = count($_POST['itemname']);
            for ($i = 0; $i < $count; $i++) {
                $slipinfo = [
                    'customer_id' => $cid,
                    'item' => $_POST['itemname'][$i],
                    'qty' => $_POST['qty'][$i],
                    'price_per_unit' => $_POST['price_per_unit'][$i],
                    'discount_per_unit' => $_POST['discount_per_unit'][$i],
                    'total' => $_POST['total'][$i],
                    'after_discount_price_per_unit' => $_POST['after_discount_price_per_unit'][$i],
                ];
                $obj->save($slipinfo);
            }
        }
    }
    ?>
    <div class="container my-5">
        <h2 class="text-center text-primary mb-4">Booking Form</h2>
        <form method="post">
            <div class="form-container">
                <!-- General Information Section -->
                <div class="form-section">
                    <h5>General Information</h5>
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="mobile" class="form-label">Mobile</label>
                                <input type="text" id="mobile" class="form-control" name="mobile" placeholder="Enter Mobile" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="dateofevent" class="form-label">Date Of Event</label>
                                <input type="date" id="dateofevent" name="dateofevent" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="place" class="form-label">Place</label>
                                <input type="text" id="place" class="form-control" name="place" placeholder="Enter Place" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="purpose" class="form-label">Purpose</label>
                            <textarea id="purpose" class="form-control" rows="3" name="purpose" placeholder="Enter The Purpose Of Booking"></textarea>
                        </div>
                    </form>
                </div>

                <!-- Item Details Section -->
                <div id="parentdiv">
                    <h5>Item Details</h5>
                    <div class="form-section" id="childdiv1">

                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="item" class="form-label">Select Item</label>
                                <select id="item" name="item[]" class="form-select" onchange="setPrice(this,'<?= ROOT; ?>',1)">
                                    <option value="" selected disabled>Select an item</option>
                                    <?php foreach ($allitems as $item) { ?>
                                        <option value="<?= $item['id']; ?>"><?= $item['item']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-2 " id="dprice1">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <input type="text" id="price1" name="price_per_unit[]" class="form-control" placeholder="Price" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text">-</span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" id="quantity1" name="qty[]" onkeyup="calprice(this)" class="form-control" placeholder="Quantity" min="1" onchange="calprice(this)" required>
                            </div>
                            <div class="col-md-2">
                                <label for="after discount" class="form-label">Final Price(Per Unit) </label>
                                <input type="number" id="afterdiscount1" name="after_discount_price_per_unit[]" class="form-control" onkeyup="calprice(this)" onchange="calprice(this)" placeholder="value After Discount">
                            </div>
                            <div class="col-md-2">
                                <label for="discount" class="form-label">Discount(Per Unit)</label>
                                <input type="text" id="discount1" name="discount_per_unit[]" onchange="calprice(this)" class="form-control" placeholder="discount" readonly>
                            </div>



                            <div class="col-md-2">
                                <label for="total" class="form-label">Total</label>
                                <input type="text" id="total1" class="form-control" name="total[]" placeholder="total" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <input type="hidden" id="totnode" value="1">
                    <button type="button" class="btn btn-success" onclick="createNodess('<?= ROOT; ?>')">New</button>
                </div>
                <!-- Submit Button -->
                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-primary">Submit Booking</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function setPrice(sel, root, elno) {
            let id = sel.value;
            $.ajax({
                url: root + "menu/loaditem",
                type: "get",
                data: "id=" + id + "&eleno=" + elno,
                success: function(r) {
                    document.getElementById('dprice' + elno).innerHTML = r;
                    let topnode = sel.parentNode.parentNode.parentNode;
                    topnode.children[0].children[3].children[1].value = topnode.children[0].children[1].children[1].children[0].value;


                    calprice(sel);
                },
                error: function(e) {
                    alert("error");
                }
            });
        }

        function createNodess(root) {
            totnode.value = Number(totnode.value) + 1;
            const x = childdiv1.cloneNode(true);
            x.children[0].children[1].id = "dprice" + totnode.value;
            let sel = x.children[0].children[0].children[1];
            sel.removeAttribute('onchange', '');

            sel.addEventListener('change', () => {
                setPrice(sel, root, totnode.value);
            })

            x.id = "childdiv" + totnode.value;
            x.children[0].children[1].children[1].children[0].value = "";

            x.children[0].children[2].children[1].value = "";
            x.children[0].children[3].children[1].value = "";
            x.children[0].children[4].children[1].value = "";
            x.children[0].children[5].children[1].value = "";
            parentdiv.appendChild(x);

        }

        function calprice(obj) {

            let topnode = obj.parentNode.parentNode.parentNode;
            let item = topnode.children[0].children[0].children[1];
            let price = topnode.children[0].children[1].children[1].children[0];

            let qty = topnode.children[0].children[2].children[1];
            let fp = topnode.children[0].children[3].children[1];
            let dis = topnode.children[0].children[4].children[1];
            let tot = topnode.children[0].children[5].children[1];
            console.log(price);

            if (price.value) {
                if (qty.value && fp.value) {
                    dis.value = price.value - fp.value;
                    tot.value = qty.value * fp.value;
                }
            } else {
                qty.value = fp.value = "";

                alert("First select item");
                item.focus();
            }

        }
    </script>