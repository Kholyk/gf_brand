<?php // Post navigation links?>
<hr>
<div id="post-navigation" class="row align-items-center justify-content-around text-success">
    <div class="col-lg-6 col-lg-6 d-none d-md-block text-left link-block">
        <span class="display-3">&larr;</span><br />
        <?php previous_post_link(); ?>
    </div>
    <div class="col-lg-6 col-lg-6 d-none d-md-block text-right link-block justify-content-end">
            <span class="display-3">&rarr;</span><br />
            <?php next_post_link(); ?>
    </div>
</div>
				