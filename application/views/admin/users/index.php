<?php include APPPATH . 'views/admin/include/header.php'; ?>
<br>
<h2> Lista użytkowników </h2>
<?php echo anchor('admin/users/create', 'Dodaj użytkownika'); ?>
<br><br>
<?php if(!empty($users)): ?>
	<?php foreach ($users as $row): ?>

		<?php echo($row->id); ?>

		<?php echo($row->name); ?>
	
		<?php echo($row->email); ?>

		

		<?php echo anchor('admin/users/edit/' . $row->id, 'Edytuj'); ?>
		<?php echo anchor('admin/users/delete/' . $row->id, 'Usuń', array('onclick' =>"return confirm ('Czy na pewno chcesz usunać uzytkownika?');")); ?>
	
		</br>
		</br>

	<?php endforeach; ?>	
<?php else: ?>
	<h2> Brak użytkowników </h2>
<?php endif; ?>