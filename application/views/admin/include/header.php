<?php echo anchor(site_url(), 'Strona glowna '); ?>

<?php if($loggedin == TRUE): ?>
<?php echo anchor('admin/panel',' Panel Administratora '); ?>
<?php echo anchor('admin/users',' Użytkownicy '); ?>
<?php echo anchor('admin/panel/logout',' Wyloguj'); ?>
<?php endif; ?>
	