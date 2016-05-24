<?php /*Template Name: Contacts*/get_header(); ?>    <div id="primary" class="content-area">        <main id="main" class="site-main" role="main">            <div class="post-cover"                 style="background-image:url('http://www.henripourrat.com/wp-content/uploads/2016/03/write-593333_1920.jpg');">            </div>            <div class="post-top wrapper">                <div class="post-title">                    <h1>Contact</h1>                </div>            </div>            <div class="post-article wrapper clearfix">                <div class="table">                    <?php                    $args = array('post_type' => array('contact'), 'posts_per_page' => -1);                    $query = new WP_Query($args);                    while ($query->have_posts()) :                        $query->the_post();                        $numero = get_field('telephone');                        $titre = get_field('titre');                        $adresse = get_field('courrier');                        $mail = get_field('email');                        ?>                        <div class="table-row">                            <div class="table-cell">                                <p><?= $titre; ?></p>                            </div>                            <div class="table-cell">                                <p><?php echo the_title(); ?></p>                            </div>                            <div class="table-cell">                                <a href="#" data-type="phone"                                   data-hidden="<?php echo get_template_directory_uri() . '/generate_png.php?number=' . $numero; ?>"><i class="fa fa-phone"></i> </a>                            </div>                            <div class="table-cell">                                <a href="#" data-type='mail' data-hidden="<?= crypt_mail($mail); ?>"><i class="fa fa-at"></i> </a>                            </div>                            <div class="table-cell">                                <a href="" data-type='address' data-hidden="<?= $adresse; ?>"><i class="fa fa-envelope"></i> </a>                            </div>                        </div>                        <?php                    endwhile; // End of the loop.                    ?>                </div>            </div>            <span class="triangle_bottom border-white"></span>        </main><!-- #main -->    </div><!-- #primary -->    <script>        function replaceContact(data, content, div){            switch(data) {                case 'phone':                    div.append('<img src="'+content+'" alt=""/>');                    div.find('a').remove();                break;                case 'mail':                    div.append('<p>'+atob(content)+'</p>');                    div.find('a').remove();                    break;                case 'address':                    div.append('<p>'+content+'</p>');                    div.find('a').remove();                    break;        }     }     $('body').on('click', '.table-cell', function(){        var t = $(this);        if(t.find('a').data('type')){            replaceContact(t.find('a').data('type'), t.find('a').data('hidden'), t);        }         return false;    });    </script><?php  get_footer();