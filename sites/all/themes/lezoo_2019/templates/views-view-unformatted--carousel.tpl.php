<div id="views-bootstrap-carousel-<?php print $id ?>" class="swiper loading loading-full <?php print $classes ?>" <?php print $attributes ?>>
  <div class="controls">
    <!-- Carousel navigation -->
    <a class="carousel-control left" href="#" data-slide="prev">&lsaquo;</a>
    <!-- Carousel indicators -->
    <ol class="carousel-indicators">

    </ol>
    <a class="carousel-control right" href="#" data-slide="next">&rsaquo;</a>
  </div>
  <!-- Carousel items -->
  <div class="swiper-wrapper carousel-inner">
    <?php foreach ($rows as $key => $row): ?>
    <div class="item <?php if ($key === 0) print 'active' ?>">
      <?php print $row ?>
    </div>
    <?php endforeach; ?>
  </div>
</div>
