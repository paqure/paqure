<?php

/*** PAQURE LIBRARY INCLUDES ***/

$fsi = new FilesystemIterator(__DIR__.'/lib');

foreach ($fsi as $fil) {

    require_once($fil);

}

