<?php
/**
 * @file Output of the WYSIWYG popup
 *
 * Available variables:
 *  - $variables['path']
 *  - $variables['tinymce_path']
 *  - $variables['tinymce_js']
 *  -
 *
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>SoundCloud filter WYSIWYG popup</title>
    <link type="text/css" rel="stylesheet" media="all" href="<?php echo $variables['path'] ?>/wysiwyg/popup.css" />
    <script type="text/javascript" src="<?php echo $variables['tinymce_js'] ?>"></script>
    <script type="text/javascript" src="<?php echo $variables['path'] ?>/wysiwyg/tinymce/popup.js"></script>	
  </head>
  <body id="soundcloud_filter_popup">
    <div class="clearfix">
      <?php print $form; ?>
    </div>
  </body>
</html>
