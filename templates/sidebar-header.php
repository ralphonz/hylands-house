<?php use Roots\Sage\Assets; ?>

<div class="newsletter-navigation" role="navigation">
  <div class="arrow prev-arrow"><?= file_get_contents(Assets\asset_path("images/arrow.svg"));?></div>
  <ul class="nav nav-pills">
    <?php
    global $wpdb;

    $limit = 0;
    $year_prev = null;
    $months = $wpdb->get_results("SELECT DISTINCT MONTH( post_date ) AS month ,  YEAR( post_date ) AS year,  ( ID ) AS id, COUNT( id ) as post_count FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'post' GROUP BY month , year ORDER BY post_date DESC");

    foreach($months as $month) :

        $year_current = $month->year;

        // print_r($month);
        // print_r($post);

        if ($year_current != $year_prev){

          if ($year_prev != null) {
            ?> </ul></li> <?php
          }
       
          ?> <li class="archive-year"><?php echo $month->year; ?><ul class="nav"> <?php
         
         } ?>

        <li class="nav-item <?php if ($month->id == $post->ID) { ?> active<?php } ?>"><a href="<?php bloginfo('url') ?>/<?php echo $month->year; ?>/<?php echo date("m", mktime(0, 0, 0, $month->month, 1, $month->year)) ?>"><span class="archive-month"><?php echo date_i18n("F", mktime(0, 0, 0, $month->month, 1, $month->year)) ?></span></a></li> <?php

        $year_prev = $year_current;
 
     
    if(++$limit >= 18) { break; }
     
    endforeach; ?>
    </ul></li>
  </ul>
  <div class="arrow next-arrow"><?= file_get_contents(Assets\asset_path("images/arrow.svg")); ?></div>
</div>

