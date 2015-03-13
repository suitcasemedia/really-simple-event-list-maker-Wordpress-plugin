<?php get_header(); ?>
<div id="main-content">
  <div class="container">
    <div id="content-area" class="clearfix">
      <div id="left-area">
        <?php while ( have_posts() ) : the_post(); 
        $meta = get_post_meta( get_the_id(), '' ); 
        ?>
        <h1><?php the_title(); ?></h1>
        <table style="width:100%;">
          <tr>
            <td><strong>Event name:</strong></td> <td><?php the_title(); ?> </td>
          </tr>
          <tr>
           <td><strong>Venue: </strong></td><td>  <?php echo $meta['venue'][0] ?> </td>
         </tr>
         <tr>
           <td><strong>Date:  </strong>
           </td></td> <td> <?php the_date( 'l F j, Y' );?>
         </tr>
         <tr>
          <td><strong>Time:</strong> </td> <td>  <?php the_time() ; ?></td>
        </tr>
      </table>
      <?php the_content(); ?>
    <?php endwhile; ?>
  </div> <!-- #left-area -->
  <?php get_sidebar(); ?>
</div> <!-- #content-area -->
</div> <!-- .container -->
</div> <!-- #main-content -->
<?php get_footer(); ?>
