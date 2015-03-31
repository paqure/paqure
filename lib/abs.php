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

    /* @property object PDO Connection Handle */
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

/* ABSTRACT MODEL */
abstract class Mdl extends Obj
{

    /* @property object database singleton */
    protected $dbs;

    /* @property string table name */
    protected $tbl;


}

/* ABSTRACT VIEW */
abstract class Vue extends Obj
{

    /* @property int type (1,2,3) */
    protected $typ;

    /* @property string (xml) */
    protected $xml;

    /* @property string (tag) */
    protected $tag;

    /* @property array (attributes) */
    protected $atr;

    /* @property int (self-closing--1 or 0) */
    protected $scl;

    /* @property array of vue objects (content) */
    protected $cnt;

    /**
     * @param string (xml)
     */
    public function setXml($arg)
    {

        $this->typ = 1;
        $this->xml = $arg;
        $this->tag = null;
        $this->atr = null;
        $this->scl = null;
        $this->cnt = null;

    } // .setXml()

    /**
     * @param assoc
     */
    public function setTag($arg)
    {

        $this->typ = 2;
        $this->xml = null;
        $this->tag = $arg['tag'];

        if(isset($arg['atr'])) {

            $this->atr = $arg['atr'];

        }

        if(isset($arg['scl'])) {

            $this->scl = $arg['scl'];

        } else {

            $this->scl = 0;

        }

    } // ./setTag()

    /**
     * @param array
     */
    public function setCnt($arg)
    {

        if(isset($this->tag)) {

            $this->typ = 2;

        } else {

            $this->typ = 3;

        }

        $this->cnt = $arg;

    } // ./setCnt()

    /**
     * @return string (html)
     */
    public function htm()
    {

        switch($this->typ) {

            case 1:
                return $this->xml;
                break;
            case 2:
                return $this->gde();
                break;
            case 3:
                return $this->pva();
                break;
            default:
                return null;

        }

    }

    /**
     * Generate DOM Element
     * @return string
     */
    protected function gde()
    {
        // open html tag
        $htm = '<'.$this->tag;

        if (isset($this->atr)) {

            foreach ($this->atr as $key=>$val) {

                $htm .= ' '.$key.'="'.$val.'"';

            }

        } // ./if atr

        $htm .= '>'.PHP_EOL;

        // check for content
        if(isset($this->cnt)) {

            $htm .= $this->pva();

        } // ./if cnt

        // check if not self-closing
        if($this->scl!=1) {

            $htm .= '</'.$this->tag.'>'.PHP_EOL;

        }

        return $htm;

    }

    /**
     * Parse View Array
     * @return string
     */
    protected function pva()
    {
        $htm = '';

        foreach ($this->cnt as $vue) {

            $htm .= $vue->htm();

        }

        return $htm;

    }

} // ./Vue

/* ABSTRACT CONTROLLER */
abstract class Ctl extends Obj
{

    protected $mdl;

    protected $vue;

    protected function out()
    {

        echo $this->vue->htm();

    }

}