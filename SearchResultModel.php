<?php
/**
 * Created by PhpStorm.
 * User: graymind
 * Date: 8/25/18
 * Time: 3:17 PM
 */

class SeachResultModel
{
    private $searched;
    private $index;
    private $before;
    private $after;
    private $isFinded = false;


    public function Create($searched,$index,$size){
        $this->searched = $searched;

        $this->isFinded = true;

        $this->index = $index;

        $this->before = -- $index;

        $this->after =  ($size -1) - $index;
    }

    public function getBefore()
    {
        return $this->before;
    }

    public function getAfter()
    {
        return $this->after;
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function isFinded(){
        return $this->isFinded;
    }

    public function getSearched(){
        return $this->searched;
    }
}
