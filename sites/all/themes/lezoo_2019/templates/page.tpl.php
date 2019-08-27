<header id="navbar" role="banner" class="<?php print $navbar_classes; ?> navbar-fixed-top">
  <?php if ($logo): ?>
    <a class="logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
      <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
    </a>
  <?php endif; ?>
    <?php if (!empty($page['navigation'])): ?>
        <?php print render($page['navigation']); ?>
    <?php endif; ?>

    <?php if (!empty($page['top_bar'])): ?>
        <?php print render($page['top_bar']); ?>
    <?php endif; ?>
</header>

<main <?php print $content_column_class; ?>>
      <?php if (!empty($page['highlighted'])): ?>
        <div class="highlighted hero-unit"><?php print render($page['highlighted']); ?></div>
      <?php endif; ?>
      <!-- <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>
      <a id="main-content"></a>-->
      <?php print $messages; ?>
      <!-- <?php if (!empty($tabs)): ?>
        <?php print render($tabs); ?>
      <?php endif; ?>
      -->
      <?php if (!empty($page['help'])): ?>
        <?php print render($page['help']); ?>
      <?php endif; ?>
      <?php if (!empty($action_links)): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <iframe frameborder="0" id="zoo-animals" src="/animals"></iframe>
</main>

<footer class="footer container">
  <?php print render($page['footer']); ?>
</footer>
