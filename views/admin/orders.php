<?php include 'header.php'; ?>
<h2>订单管理</h2>
<?php if(empty($orders)): ?>
    <p>暂无订单</p>
<?php else: ?>
    <table border="1" cellpadding="5" cellspacing="0" width="100%" style="background: #fff; border-collapse: collapse;">
        <tr>
            <th>订单号</th>
            <th>用户ID</th>
            <th>下单时间</th>
            <th>状态</th>
            <th>总金额</th>
            <th>操作</th>
        </tr>
        <?php foreach($orders as $order): ?>
            <tr>
                <td><?php echo $order['order_id']; ?></td>
                <td><?php echo $order['user_id']; ?></td>
                <td><?php echo $order['order_date']; ?></td>
                <td><?php echo $order['order_status']; ?></td>
                <td>￥<?php echo number_format($order['total_amount'], 2); ?></td>
                <td>
                    <a href="../controllers/AdminController.php?action=edit_order&id=<?php echo $order['order_id']; ?>">编辑</a> |
                    <a href="../controllers/AdminController.php?action=delete_order&id=<?php echo $order['order_id']; ?>" onclick="return confirm('确定删除订单？');" style="color: #d9534f;">删除</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
<?php include 'footer.php'; ?>
