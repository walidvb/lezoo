<div id="views-bootstrap-carousel-<?php print $id ?>" class="swiper <?php print $classes ?>" <?php print $attributes ?>>
    <!-- Carousel indicators -->
    <ol class="carousel-indicators">
    
    </ol>
  
  <!-- Carousel items -->
  <div class="swiper-wrapper carousel-inner">
    <?php foreach ($rows as $key => $row): ?>
      <div class="item <?php if ($key === 0) print 'active' ?>">
        <?php print $row ?>
      </div>
    <?php endforeach ?>
  </div>

  <?php if ($navigation): ?>
    <!-- Carousel navigation -->
    <a class="carousel-control left" href="#views-bootstrap-carousel-<?php print $id ?>" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#views-bootstrap-carousel-<?php print $id ?>" data-slide="next">&rsaquo;</a>
  <?php endif ?>
</div>