<?php
/* Smarty version 5.5.1, created on 2025-08-02 14:38:35
  from 'file:carDetails.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_688e22eba5d9f4_29106236',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '73719d2ad6b52e8a346484dcf7f8131faaa1e212' => 
    array (
      0 => 'carDetails.tpl',
      1 => 1754145399,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_688e22eba5d9f4_29106236 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Project_25\\Ecommerce_Task\\resources\\views\\smarty';
?><!DOCTYPE html>
<html>
<head>
    <title><?php echo $_smarty_tpl->getValue('car')['name'];?>
</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getValue('css_url');?>
">
    <style>
        /* Reset and base styles */
        
    </style>
</head>
<body>

    <div class="container">
        <img src="<?php echo $_smarty_tpl->getValue('cars_url');?>
" alt="<?php echo $_smarty_tpl->getValue('car')['name'];?>
" class="car-image">

        <h1><?php echo $_smarty_tpl->getValue('car')['name'];?>
</h1>
        <p><strong>Model:</strong> <?php echo $_smarty_tpl->getValue('car')['model'];?>
</p>
        <p><strong>Price:</strong> ₦<?php echo $_smarty_tpl->getValue('car')['price'];?>
</p>
        <p><strong>Description:</strong> <?php echo $_smarty_tpl->getValue('car')['description'];?>
</p>

        <div class="button-group">
            <form method="POST" action="<?php echo $_smarty_tpl->getValue('addCart_url');?>
" style="display:inline;">
                  <label for="units">Quantity:</label>
                  <input type="number" id="units" name="units" min="1" value="1" required class="qty-input">
                  <input type="hidden" name="_token" value="<?php echo $_smarty_tpl->getValue('csrf_token');?>
">
                  <button type="submit" class="btn">Add to Cart</button>
            </form>

            <a href="<?php echo $_smarty_tpl->getValue('home_url');?>
" class="btn" style="background-color: #28a745;">Back to Home</a>
        </div>
    </div>

</body>
</html>
<?php }
}
