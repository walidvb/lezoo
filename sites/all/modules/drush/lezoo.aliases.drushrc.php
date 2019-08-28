<?php

	$aliases['local'] = array(
	  'root' => '/Users/Gaston/Sites/zoo',
	  'uri'  => 'http://localhost/zoo',
	 	  'path-aliases' => array(
    '%files' => 'sites/default/files',
    '%site' => 'sites/all/',
    '%modules' => 'sites/all/modules',
    '%themes' => 'sites/all/themes',
  )
	);

		
	$aliases['remote'] = array (  
	  'uri' => 'http://lezoo.vbbros.net/',
	  'root' => '/home2/vbbrosne/public_html/lezoo',
	  'remote-user' => 'vbbrosne',
	  'remote-host' => 'vbbros.net',
	  	  'path-aliases' => array(
    '%files' => 'sites/default/files',
    '%site' => 'sites/all/',
    '%modules' => 'sites/all/modules',
    '%themes' => 'sites/all/themes',
  )
	);
