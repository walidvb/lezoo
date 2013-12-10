<?php print $image ?>

<?php if (!empty($title) || !empty($description)): ?>
  <div class="carousel-caption">
    <?php if (!empty($title)): ?>
      <h5><?php print $title ?></h5>
    <?php endif ?>

    <?php if (!empty($description)): ?>
      <?php print $description ?>asd
    <?php endif ?>
  </div>
<?php endif ?>