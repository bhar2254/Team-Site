<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of robotbuildsme_entry_comment
 *
 * @author jacobc
 */
class robotbuildsme_entry_comment {
    //put your code here
    public $id;
    public $userid;
    public $userObj;
    public $email;
    public $relatedPostID;
    public $subject;
    public $comment;
    public $rating; //This will be an integer 0 being the lowest to 5 being the highest.
    public $createdip;
    public $createddate;
    
    private $dbh;
    private $res;
    private $keys = array("id", "userid", "email","relatedPostID", "subject", "comment","rating", "createdip", "createddate");
    
    public function __construct() {
        //Constructor;
    }
    public function setDBH($dbhIn)
    {
        $this->dbh = $dbhIn;
    }
    public function retreiveCommentById()
    {
        
    }
    public function populateFromResIn($resIn)
    {
        $keys = &$this->keys;
        foreach($keys as $k)
        {
            $code = "\$this->" . $k . "= \$resIn['$k.'];";
            eval($code);
        }
    }
    public function populateFromPostIn()
    {
        $keys = &$this->keys;
        $pkeys = array_keys($_POST);
        
    }
}

?>
