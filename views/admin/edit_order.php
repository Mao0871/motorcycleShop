<?php include 'header.php'; ?>
<h2>编辑订单状态</h2>
<div style="background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
    <p><strong>订单号:</strong> <?php echo $order['order_id']; ?></p>
    <p><strong>下单时间:</strong> <?php echo $order['order_date']; ?></p>
    <form action="../controllers/AdminController.php?action=update_order_status" method="POST">
        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
        <p>
            <label>订单状态:</label>
            <select name="order_status">
                <option value="Pending confirmation" <?php if($order['order_status']=="Pending confirmation") echo "selected"; ?>>Pending confirmation</option>
                <option value="Payment successful" <?php if($order['order_status']=="Payment successful") echo "selected"; ?>>Payment successful</option>
                <option value="Vehicle in preparation" <?php if($order['order_status']=="Vehicle in preparation") echo "selected"; ?>>Vehicle in preparation</option>
                <option value="Vehicle ready" <?php if($order['order_status']=="Vehicle ready") echo "selected"; ?>>Vehicle ready</option>
            </select>
        </p>
        <p>
            <button type="submit" style="padding: 8px 16px; background-color: #2980b9; color: #fff; border: none; border-radius: 3px; cursor: pointer;">更新状态</button>
        </p>
    </form>
    <hr>
    <h3>订单详情</h3>
    <?php foreach($order_items as $item): ?>
        <div style="margin-bottom: 10px;">
            <p><strong>产品:</strong> <?php echo $item['model']; ?> (<?php echo $item['type']; ?>)</p>
            <p><strong>数量:</strong> <?php echo $item['quantity']; ?></p>
            <p><strong>单价:</strong> ￥<?php echo number_format($item['price'],2); ?></p>
        </div>
    <?php endforeach; ?>
</div>
<?php include 'footer.php'; ?>
