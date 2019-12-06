<?php
		if(!isset($_SESSION['loggedIn']))
			{
				redirect(base_url(),'refresh');
			}
?>