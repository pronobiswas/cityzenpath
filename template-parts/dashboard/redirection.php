<?php

if( isset($_GET['bd']) && $_GET['bd'] !="" ) {
		$page_type  = $_GET['bd'];
		if($page_type == "forms")
		{
			get_template_part('template-parts/dashboard/layouts/forms');
		}
        else if($page_type == "dashboard")
		{
			get_template_part('template-parts/dashboard/layouts/dashboard');
		}		
		else
		{
			get_template_part( 'template-parts/dashboard/layouts/dashboard');
		}

}


?>



