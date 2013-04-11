<?php

class Application_Form_Feedback extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $notEmpty = new Zend_Validate_NotEmpty();
        $notEmpty->setMessage('Field can not be empty');
        
        $emailValidate = new Zend_Validate_EmailAddress();
        $emailValidate->setMessage('email is not valid');
        
        $alreadyExist = new Zend_Validate_Db_NoRecordExists('USers', 'email');
        $alreadyExist->setMessage('email already exist, try forgot password');
        
        
        
        
        
      
        $this->setMethod('post');
        $this->setAction('');
 
        
        
     $options = array(
            'disableLoadDefaultDecorators' => true,
            'decorators' => array(array('ViewScript', array(
                'viewScript' => '_form/element/textbox.phtml',
                'placement' => false
            ))),
            'description' => '',
            'required' => true,
            'label'      => 'Name',
            'id' => 'default'
        );
     
     $selectbox = array(
            'disableLoadDefaultDecorators' => true,
            'decorators' => array(array('ViewScript', array(
                'viewScript' => '_form/element/selectbox.phtml',
                'placement' => false
            ))),
            'description' => '',
            'required' => true,
            'label'      => 'Name',
            'id' => 'default'
        );
     
        //name    
        $options['description'] = "Type your first name here.";
        $options['id'] = "name";
        $this->addElement('text', 'name', $options);
        //$this->getElement('name')->setAttrib('id', 'name');
        
         //lname    
        $options['description'] = "Type your last name here.";
        $options['id'] = "lname";
        $this->addElement('text', 'lname', $options);
        
        //Email
        $options['label'] = 'Email';
        $options['id'] = 'email';
        $options['description'] = "Your email address.";
        $this->addElement('text', 'email', $options);
        $this->getElement('email')->addValidator($emailValidate);
        
        //address
        $options['label'] = 'Address';
        $options['id'] = 'address';
        $options['description'] = "Your first line of address.";
        $this->addElement('text', 'address', $options);
        
        //address 1
        $options['label'] = 'Address 1';
        $options['id'] = 'address1';
        $options['description'] = "Your second line of address.";
        $options['required'] = FALSE;
        $this->addElement('text', 'address1', $options);
        $this->getElement('address1')->addValidator($notEmpty);
        
        
        $selectbox['label'] = 'Country';
        $selectbox['id'] = 'country';
        $selectbox['description'] = FALSE;
        $this->addElement('select', 'country', $selectbox);
        
        
        $selectbox['label'] = 'How much have your skills improved because of the training at the Forum?';
        $selectbox['id'] = 'skills';
        $selectbox['description'] = FALSE;
        $this->addElement('select', 'skills', $selectbox);
        
       
        }



}
