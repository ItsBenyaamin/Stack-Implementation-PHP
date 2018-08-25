<?php
/**
 * Created by PhpStorm.
 * User: graymind
 * Date: 8/23/18
 * Time: 11:07 PM
 */
class StackUtil
{
    private $stack = array();
    private $top = 0;


    public function Push($data){
        if (!$this->isDuplicate($data)){
            $this->top ++ ;
            $this->stack[] = $data;
            return true;
        }
        return false;
    }

    private function isDuplicate($data){
        foreach ($this->stack as $current){
            if ($data == $current)
                return true;
        }
        return false;
    }

    public function Pop(){
        $this->top -- ;
        $item = $this->stack[$this->top];
        unset($this->stack[$this->top]);
        return $item;
    }

    public function canPop(){
        if (count($this->stack) > 0){
            return true;
        }
        return false;
    }

    public function getStack(){
        return array_reverse($this->stack);
    }

    public function Size(){
        return sizeof($this->stack) ? Count($this->stack) : 0;
    }

    public function Search($data){
        $model = new SeachResultModel();
        $index = 0;
        foreach (array_reverse($this->stack) as $current){
            $index ++;
            if ($current == $data){
                $model->Create($data,$index,$this->Size());
                return $model;
            }
        }
        return $model;
    }

    public function Sort(){
        for ($i = 0 ; $i < $this->Size(); $i++){
            for ($j = 0 ; $j < $this->Size()-1; $j++){
                if ($this->stack[$j] > $this->stack[$j+1]){
                    $this->IndexChange($j);
                }
            }
        }
    }

    private function IndexChange($index){
        $temp = $this->stack[$index];
        $this->stack[$index] = $this->stack[$index + 1];
        $this->stack[$index + 1] = $temp;
    }
}