<?php
function hash_salt($string)
{
	return hash('sha512', $string . config_item('encryption_key'));

}