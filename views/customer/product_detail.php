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
        <!-- 添加到购物车表单 -->
        <form action="../controllers/CustomerController.php?action=add_to_cart" method="POST" style="margin-top: 20px;">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
            <label for="quantity" style="margin-right: 10px;">数量:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" style="width: 60px; padding: 5px;">
            <button type="submit" style="padding: 10px 20px; background-color: #27ae60; color: #fff; border: none; border-radius: 3px; cursor: pointer; margin-left: 10px;">添加至购物车</button>
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>
