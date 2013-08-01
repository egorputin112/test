<?php if ($models) : ?>
<?php foreach ($models as $m) : ?>
(<?php echo Num::format($m['qty'], 0); ?>) <?php echo $m['name']; ?> at $<?php echo Num::format($m['price'], 2) . "\n"; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php if ($accs) : ?>
<?php foreach ($accs as $a) : ?>
(<?php echo Num::format($a['qty'], 0); ?>) <?php echo $a['name']; ?> at $<?php echo Num::format($a['price'], 2) . "\n"; ?>
<?php endforeach; ?>
<?php endif; ?>
