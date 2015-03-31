<?php
/**
 * PaQuRe LIBRARY INCLUDES
 * @package   paqure
 * @version   0.0.2
 * @author    Roderic Linguri
 * @copyright Copyright (c) 2015, Digices
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 */

define('PAQURE_ROOT',__DIR__);

$fsi = new DirectoryIterator(PAQURE_ROOT.'/lib');

foreach ($fsi as $fil) {

    if(substr($fil->getFilename(),0,1)!='.') {

        require_once(PAQURE_ROOT.'/lib/'.$fil);

    }

}

