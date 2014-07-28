<?php get_header(); ?>
  <h2>Search Result</h2>
  <section id="search_form">
    <form action="" method="POST">
      <fieldset>
        <input type="search" name="s" id="search-input">
        <button type="submit">Pesquisar</button>
      </fieldset>
    </form>
  </section>
  <?php if(have_posts()) { ?>
  <dl class="result-search">
    <?php while(have_posts()) { the_post(); 

      $postxt = ($post->excerpt == '') : $post->post_content ? $post->post_excerpt;

    ?>
    <dt class="title">
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
      </a>
    </dt>
    <dd class="description">
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php getTruncateText($postxt, 100); ?>
      </a>
    </dd>
    <?php } ?>
  </dl>
  <?php } else { ?>
  <p><?php echo __e('Nothing result.'); ?></p>
  <?php } ?>
<?php get_footer(); ?>