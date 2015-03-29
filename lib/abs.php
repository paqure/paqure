<?php
/**
 * PaQuRe ABSTRACT CLASSES
 * @package   paqure
 * @version   0.0.2
 * @author    Roderic Linguri
 * @copyright Copyright (c) 2015, Digices
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace paqure;

/* ABSTRACT OBJECT */
abstract class Obj
{


} // ./Obj

/* ABSTRACT DATABASE */
abstract class Dbs extends Obj
{

    /* @property PDO Connection Handle */
    protected $pch;


    /**
     * Execute an SQL query
     * @param  string (sql query string)
     * @return int (row count)
     */
    public function exe($arg)
    {

        $sth = $this->pch->prepare($arg);

        $sth->execute($arg);

        return $sth->rowCount();

    } // ./exe()

} // ./Dbs
