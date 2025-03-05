<?php include 'header.php'; ?>
<h2>支付结算</h2>
<div style="background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
    <h3>订单总金额: ￥<?php echo number_format($total, 2); ?></h3>
    <form action="../controllers/CustomerController.php?action=process_checkout" method="POST">
        <p>
            <label>银行卡卡号:</label>
            <input type="text" name="card_number" required style="padding: 5px; width: 200px;">
        </p>
        <p>
            <label>CCV:</label>
            <input type="text" name="card_ccv" required style="padding: 5px; width: 80px;">
        </p>
        <p>
            <label>到期时间 (MM/YYYY):</label>
            <input type="text" name="card_expiration" 
        required 
        style="padding: 5px; width: 100px;"
        placeholder="MM/YYYY"
        pattern="(0[1-9]|1[0-2])\/[0-9]{4}"
        title="请输入有效日期格式，例如 12/2025">
        </p>
        <p>
            <button type="submit" style="padding: 10px 20px; background-color: #27ae60; color: #fff; border: none; border-radius: 3px; cursor: pointer;">结算订购</button>
        </p>
    </form>
</div>
<?php include 'footer.php'; ?>
