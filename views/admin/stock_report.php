<?php include 'header.php'; ?>
<h2>库存报告</h2>
<div style="margin-bottom: 20px;">
    <button onclick="window.print()" style="padding: 8px 16px; background-color: #28a745; color: #fff; border: none; border-radius: 3px; cursor: pointer;">打印报告</button>
</div>

<table border="1" cellpadding="8" cellspacing="0" width="100%" style="background: #fff; border-collapse: collapse;">
    <tr style="background-color: #343a40; color: #fff;">
        <th>图片</th>
        <th>型号</th>
        <th>类别ID</th>
        <th>价格</th>
        <th>库存</th>
        <th>状态</th>
    </tr>
    <?php foreach($products as $product): ?>
    <tr style="<?php if($product['stock'] <= 0) echo 'background-color: #f8d7da;'; ?>">
        <td style="text-align: center;">
            <?php if(!empty($product['image_url'])): ?>
                <img src="../<?php echo $product['image_url']; ?>" alt="<?php echo $product['model']; ?>" style="width: 60px; height: 60px;">
            <?php else: ?>
                <span>暂无图片</span>
            <?php endif; ?>
        </td>
        <td><?php echo $product['model']; ?></td>
        <td><?php echo $product['category_id']; ?></td>
        <td>￥<?php echo number_format($product['price'], 2); ?></td>
        <td><?php echo $product['stock']; ?></td>
        <td>
            <?php if($product['stock'] <= 0): ?>
                <span style="color: #d9534f; font-weight: bold;">⚠ 缺货</span>
            <?php else: ?>
                <span style="color: #28a745;">有库存</span>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include 'footer.php'; ?>
