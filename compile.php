#!/usr/bin/php

<?php
   // Small script that compiles all the handle templates into .template files
 
   $d = dir('templates');
   $dir = $d->path . '/';

    while(false !== ($entry = $d->read()))
    {
        if(strpos($entry, '.handlebars') !== false)
	{    
            $name = explode('.', $entry);
	    $command = 'handlebars ' . $dir . $entry . ' -f ' . $dir . $name[0] . '.template';
	    echo $command . "\n";
	    exec($command);
   	}
    }

    $d->rewind();
    while(false !== ($entry = $d->read()))
    {
        if(strpos($entry, '.template') !== false)
        {
	       file_put_contents($dir . 'master_template.js', file_get_contents($dir . $entry), FILE_APPEND);
           unlink($dir . $entry);
        }
    }
?>
