<?php include 'header.php'; ?>
<h2>产品主页</h2>
<!-- 筛选产品 -->
<form action="../controllers/CustomerController.php" method="GET" style="margin-bottom:20px;">
    <input type="hidden" name="action" value="home">
    <label for="category_id">选择类别:</label>
    <select name="category_id" id="category_id">
        <option value="all">全部</option>
        <?php foreach($categories as $cat): ?>
            <option value="<?php echo $cat['category_id']; ?>"><?php echo $cat['category_name']; ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" style="padding: 5px 10px;">确定</button>
</form>

<!-- 产品展示区域 -->
<div style="display: flex; flex-wrap: wrap; gap: 20px;">
    <?php if (!empty($products)): ?>
        <?php foreach($products as $p): ?>
            <div style="background: #fff; width: 200px; border: 1px solid #ddd; border-radius: 5px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <a href="../controllers/CustomerController.php?action=product_detail&id=<?php echo $p['product_id']; ?>" style="text-decoration: none; color: inherit;">
                    <div style="height: 150px; background: #f9f9f9; display: flex; align-items: center; justify-content: center;">
                        <?php if(!empty($p['image_url'])): ?>
                            <img src="../<?php echo $p['image_url']; ?>" alt="<?php echo $p['model']; ?>" style="max-height: 100%; max-width: 100%;">
                        <?php else: ?>
                            <span>暂无图片</span>
                        <?php endif; ?>
                    </div>
                    <div style="padding: 10px;">
                        <h3 style="font-size: 16px; margin: 0 0 10px;"><?php echo $p['model']; ?></h3>
                        <p style="margin: 0; color: #e74c3c; font-weight: bold;">￥<?php echo $p['price']; ?></p>
                        <p style="margin: 5px 0 0; font-size: 12px; color: #999;">库存: <?php echo $p['stock']; ?></p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>暂无产品</p>
    <?php endif; ?>
</div>
<?php include 'footer.php'; ?>
