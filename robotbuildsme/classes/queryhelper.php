<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * The purpose of this class is to help write long sql statements based on object oriented data. This class should be 
 * designed to be available and reusable.
 *
 * @author jacobc
 */
class queryhelper {
    //put your code here
    public $resIn;
    public $queryWrote;
    public $res;
    public $keys;
    public $condensed = array();
    public $tmpObj;
    public $tableName;
    public $keyColum = "";
    public $keyValue = "";
    
    public function __construct() {
        //This will help construct the class.
    }
    public function getInfoFromObjects()
    {
        
    }
    public function __toString() {
        return $this->queryWrote;
    }
    public function generateInsertQueryFromCondensed()
    {
        $condensed = &$this->condensed;
        $query = &$this->queryWrote;
        $keys = array_keys($condensed);
        $ccount = count($condensed);
        $ekc = $ccount - 1;
        $ckeys = $keys;
        if(true)
        {
            if(isset($this->tableName) && !empty($this->tableName))
            {
                if($ccount > 0)
                {
                    //Now begin query generation.
                    $query = "INSERT into " . $this->tableName;
                    $query .= " (";
                    
                    for($i = 0; $i< $ccount; $i++)
                    {
                        $query .= "\"";
                        $query .= $ckeys[$i];
                        $query .= "\"";
                        
                        if($i != $ekc)
                        {
                            $query .= ", ";
                        }
                    }
                    $query .= ")";
                    $query .= " VALUES ";
                    $query .= "(";
                    for($i=0; $i<$ccount; $i++)
                    {
                        $query .= "'";
                        $query .= $condensed[$ckeys[$i]];
                        $query .= "'";
                        if($i != $ekc)
                        {
                            $query .= ", ";
                        }
                    }
                    $query .= ")";
            }
        }
    }
    }
    private function consumeArrayToPgArray($arrayIn)
    {
        $out = "";
        $countA = count($arrayIn);
        $endC = $countA - 1;
        $out .= "{";
        for($i=0; $i<$countA; $i++)
        {
            $out .= "\"";
            $out .= $arrayIn[$i];
            $out .= "\"";
            if($i != $endC)
            {
                $out .= ", ";
            }
        }
        $out .= "}";
        return $out;
    }
    public function generateUpdateQueryFromCondensed($setBlankToNull = false)
    {
        $condensed = &$this->condensed;
        $query = &$this->queryWrote;
        $ccount = count($condensed);
        $keys = array_keys($condensed);
        $ckeys = $keys;
        $ekc = $ccount - 1;
        
        if($this->keyColum != "" && $this->keyValue != "")
        {
            //echo "keycolumsn is yes\n";
            if(isset($this->tableName) && !empty($this->tableName))
            {
                //echo "tables set yes\n";
                if($ccount > 0)
                {
                    $query = "UPDATE " . $this->tableName . " SET ";
                    for($i = 0; $i<$ccount; $i++)
                    {
                        $query .= "\"";
                        $query .= $keys[$i];
                        $query .= "\"";
                        
                        if($setBlankToNull)
                        {
                            $val = $condensed[$ckeys[$i]];
                            if($val == "" && $val == null)
                            {
                                $query .= " = ";
                                $query .= "NULL";
                            }
                            else
                            {
                                $query .= " = ";
                                $query .= "'";
                                $query .= $condensed[$ckeys[$i]];
                                $query .= "'";
                            }
                        }
                        else
                        {
                            $query .= " = ";
                            $query .= "'";
                            $query .= $condensed[$ckeys[$i]];
                            $query .= "'";
                        }
                        if($i != $ekc)
                        {
                            $query .= ", ";
                        }
                        
                    }
                    $query .= " WHERE " . "\"" . $this->keyColum . "\" = '" . $this->keyValue . "'";
                    
                    
                }
            }
        }
    }
    public function generateCondensedArray($isUpdate = false)
    {
        $condensed = &$this->condensed;
        $keys = &$this->keys;
        $res;
        $tmpObj = &$this->tmpObj;
        if(isset($this->resIn))
        {
            $res = &$this->resIn;
        }
        else
        {
            $res = &$this->res;
        }
        //Now that the variables are set, lets generate the condensed array.
        if($isUpdate)
        {
            foreach($keys as $k)
            {
                $val;
                $rval;
                $rval = $res[$k];
                $code = "\$val = \$tmpObj->" . $k .";";
                eval($code);
                if($val != $rval)
                {
                    $condensed[$k] = $val;
                }
            }
        }
        else
        {
            foreach($keys as $k)
            {
                $val;
                $code = "\$val = \$tmpObj->" . $k . ";";
                eval($code);
                if($val != "" && $val != null)
                {
                    $condensed[$k] = $val;
                }
            }
        }
    }
    
    
}

?>
