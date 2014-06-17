<?php include APPPATH . 'views/admin/include/header.php'; ?>
<?php echo validation_errors(); ?>

<?php echo form_open(); ?>

<table>
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
		
		<td><?php  echo form_submit('submit', 'Zaloguj');?></td>
	</tr>
</table>


<?php echo form_close(); ?>

