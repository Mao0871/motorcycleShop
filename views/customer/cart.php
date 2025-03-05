<?php include 'header.php'; ?>
<h2>购物车</h2>
<?php if (empty($cart_items)): ?>
    <p>购物车为空</p>
<?php else: ?>
    <form action="../controllers/CustomerController.php?action=update_cart" method="POST">
        <table border="1" cellpadding="5" cellspacing="0" width="100%" style="background:#fff; border-collapse: collapse;">
            <tr>
                <th>产品</th>
                <th>单价</th>
                <th>数量</th>
                <th>小计</th>
                <th>操作</th>
            </tr>
            <?php $total = 0; ?>
            <?php foreach($cart_items as $item): ?>
                <?php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; ?>
                <tr>
                    <td style="text-align: left; padding: 10px;">
                        <?php if(!empty($item['image_url'])): ?>
                            <img src="../<?php echo $item['image_url']; ?>" alt="<?php echo $item['model']; ?>" style="width:50px; height:50px; vertical-align: middle; margin-right: 10px;">
                        <?php endif; ?>
                        <?php echo $item['model']; ?>
                    </td>
                    <td style="text-align: right;">￥<?php echo number_format($item['price'], 2); ?></td>
                    <td style="text-align: center;">
                        <input type="hidden" name="cart_item_id[]" value="<?php echo $item['cart_item_id']; ?>">
                        <input type="number" name="quantity[]" value="<?php echo $item['quantity']; ?>" min="0" style="width: 50px; text-align: center;">
                    </td>
                    <td style="text-align: right;">￥<?php echo number_format($subtotal, 2); ?></td>
                    <td style="text-align: center;">
                        <a href="../controllers/CustomerController.php?action=remove_from_cart&id=<?php echo $item['cart_item_id']; ?>" onclick="return confirm('确定删除该商品？');" style="color: #d9534f;">删除</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" align="right" style="padding: 10px;">总计:</td>
                <td align="right" style="padding: 10px;">￥<?php echo number_format($total, 2); ?></td>
                <td></td>
            </tr>
        </table>
        <p style="margin-top: 10px;">
            <button type="submit" style="padding: 8px 16px; background-color: #2980b9; color: #fff; border: none; border-radius: 3px; cursor: pointer;">更新购物车</button>
            <button type="button" style="padding: 8px 16px; background-color: #27ae60; color: #fff; border: none; border-radius: 3px; cursor: pointer; margin-left: 10px;">去结算</button>
        </p>
    </form>
<?php endif; ?>
<?php include 'footer.php'; ?>
