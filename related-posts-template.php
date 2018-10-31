<?php if (!empty($related_posts)) { ?>
<div class="container">
    <div class="row">
        <?php
            foreach ($related_posts as $post) {
                setup_postdata($post);
            ?>
        <div class="col-md-4">
            <figure class="imghvr-blur">
                <?php
                    if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'normal' );
                    }
                 ?>
                <a href="<?php echo get_post_meta( get_the_ID(), 'Link', true ); ?>">
                    <?php _e( 'Link', 'st2' ); ?>
                    <figcaption>
                        <div class="row pg-empty-placeholder">
                            <div class="col-md-6">
                                <a class="btn active hvr-sweep-to-left h-auto w-auto shadow-sm text-light btn-sm border border-light" role="button" aria-pressed="true" data-html="false" href="<?php echo get_post_meta( get_the_ID(), 'T&C´s link', true ); ?>" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" title="<?php echo get_post_meta( get_the_ID(), 'Key', true ); ?>"><?php _e( 'T&C´s', 'st2' ); ?></a> 
                            </div>
                            <div class="col-md-6">
                                <a class="btn active hvr-sweep-to-top btn-light shadow-sm bg-light float-right text-uppercase font-weight-bold text-success btn-sm" role="button" aria-pressed="true" data-html="true" href="<?php echo get_post_meta( get_the_ID(), 'Link', true ); ?>"><?php _e( 'Play', 'st2' ); ?></a> 
                            </div>
                        </div>
                        <div class="col-md-12"> 
                            <h6 class="text-center display-5 "><?php the_title(); ?></h6>
                            <?php the_excerpt( ); ?>
                        </div>
                    </figcaption>
                </a>
            </figure>             
        </div>
         <?php } ?>
    </div>
</div>
<?php
}