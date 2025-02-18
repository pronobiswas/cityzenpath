<?php
/* Template Name: User Dashboard */


if(is_user_logged_in())
    {
        ?>

        <main class="page-content content-wrap">            
            <?php				
                get_template_part( 'template-parts/dashboard/sidebar','' );				
            ?>
            <div class="page-inner">
                <?php get_template_part( 'template-parts/dashboard/header','' ); ?>    
                <div id="main-wrapper">
                    <div class="row">
                        <?php get_template_part( 'template-parts/dashboard/redirection' ); ?>     
                    </div>
                </div>
            </div>
        </main>      
         
        <?php get_template_part( 'template-parts/dashboard/footer','' ); 
        
    }
	else
	{
		wp_redirect(home_url());
	}


?>