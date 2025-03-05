<?php include 'header.php'; ?>
<h2>产品详情</h2>
<div style="display: flex; background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
    <div style="flex: 1; text-align: center;">
        <?php if(!empty($product['image_url'])): ?>
            <img src="../<?php echo $product['image_url']; ?>" alt="<?php echo $product['model']; ?>" style="max-width: 100%; max-height: 300px;">
        <?php else: ?>
            <span>暂无图片</span>
        <?php endif; ?>
    </div>
    <div style="flex: 2; padding-left: 20px;">
        <h3><?php echo $product['model']; ?></h3>
        <p style="color: #e74c3c; font-weight: bold;">￥<?php echo $product['price']; ?></p>
        <p><strong>类型：</strong><?php echo $product['type']; ?></p>
        <p><strong>动力参数：</strong><?php echo $product['engine_power']; ?></p>
        <p><strong>库存：</strong><?php echo $product['stock']; ?></p>
        <p><strong>简介：</strong><?php echo $product['description']; ?></p>
        <!-- 添加到购物车按钮 (功能暂未实现) -->
        <button style="padding: 10px 20px; background-color: #27ae60; color: #fff; border: none; border-radius: 3px; cursor: pointer;">添加至购物车</button>
    </div>
</div>
<?php include 'footer.php'; ?>
