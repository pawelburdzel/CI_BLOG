<?php include APPPATH . 'views/admin/include/header.php'; ?>
<br>
<?php echo anchor('admin/users', 'Lista użytkowników'); ?>
<br>

<?php echo validation_errors(); ?>

<?php echo form_open(); ?>

<table>
	<tr>
		<td>Imię</td>
		<td><?php echo form_input('name'); ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><?php echo form_input('email'); ?></td>
	</tr>
	<tr>
		<td>Hasło</td>
		<td><?php echo form_password('password'); ?></td>
	</tr>
	<tr>
		<td>Potwierdź hasło</td>
		<td><?php echo form_password('passconf'); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php  echo form_submit('submit', 'Dodaj użytkownika');?></td>
	</tr>
</table>


<?php echo form_close(); ?>

