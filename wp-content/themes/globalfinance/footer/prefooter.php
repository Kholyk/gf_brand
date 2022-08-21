<?php ?>


<contentbottom>
    <container>
        <left>
            <h2>Обратный звонок</h2>
            <?php print_r(do_shortcode('[contact-form-7 id="119" title="Contact form 1"]')); ?>
        </left>
        <right>
            <h2>Наши клиенты:</h2>
            <?php get_template_part('template-parts/footer/clients', 'none'); ?> 
            <p>Информацию по сертификатам и наградам, а также другие сведения можно найти в разделе «<a href="<?php echo get_home_url(); ?>/about/">О компании</a>»</p>
        </right>
        <?php
        if (is_single()) {
            twentyseventeen_entry_footer();
        }
        ?>

    </container>
</contentbottom>