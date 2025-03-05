<?php include 'header.php'; ?>
<h2>我的订单</h2>
<?php if(empty($orders)): ?>
    <p>暂无订单</p>
<?php else: ?>
    <?php foreach($orders as $order): ?>
        <div style="background: #fff; padding: 15px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px;">
            <p><strong>订单号:</strong> <?php echo $order['order_id']; ?></p>
            <p><strong>下单时间:</strong> <?php echo $order['order_date']; ?></p>
            <p><strong>订单状态:</strong> <?php echo $order['order_status']; ?></p>
            <p><strong>总金额:</strong> ￥<?php echo number_format($order['total_amount'], 2); ?></p>
            
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<?php include 'footer.php'; ?>
