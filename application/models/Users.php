<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Application_Model_Users extends Zend_Db_Table_Abstract{
    
    protected $_name = "user";
    
function checkUnique($username)
    {
        $select = $this->_db->select()
                            ->from($this->_name,array('email'))
                            ->where('email=?',$username);
        $result = $this->getAdapter()->fetchOne($select);
        if($result){
            return true;
        }
        return false;
    }
    
    function getId($email){
        
        $select = $this->_db->select()
                            ->from($this->_name,array('Id'))
                            ->where('email=?',$email);
        $result = $this->getAdapter()->fetchOne($select);
    return $result;
        
    }
    
  
}