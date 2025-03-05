<?php include 'header.php'; ?>
<h2>商品管理</h2>
<p><a href="../controllers/AdminController.php?action=create_product">创建新产品</a></p>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <th>产品ID</th>
        <th>型号</th>
        <th>类别</th>
        <th>类型</th>
        <th>图片</th>
        <th>价格</th>
        <th>动力参数</th>
        <th>库存</th>
        <th>操作</th>
    </tr>
    <?php foreach($products as $p): ?>
    <tr>
        <td><?php echo $p['product_id']; ?></td>
        <td><?php echo $p['model']; ?></td>
        <td><?php echo $p['category_id']; // 可优化：显示类别名称 ?></td>
        <td><?php echo $p['type']; ?></td>
        <td>
            <?php if($p['image_url']): ?>
                <img src="../<?php echo $p['image_url']; ?>" alt="产品图片" style="width:50px;height:50px;">
            <?php endif; ?>
        </td>
        <td><?php echo $p['price']; ?></td>
        <td><?php echo $p['engine_power']; ?></td>
        <td><?php echo $p['stock']; ?></td>
        <td>
            <a href="../controllers/AdminController.php?action=edit_product&id=<?php echo $p['product_id']; ?>">编辑</a> |
            <a href="../controllers/AdminController.php?action=delete_product&id=<?php echo $p['product_id']; ?>" onclick="return confirm('确定删除该产品？');">删除</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include 'footer.php'; ?>
