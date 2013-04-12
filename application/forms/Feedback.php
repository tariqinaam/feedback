<?php

class Application_Form_Feedback extends Zend_Form {

    public function init() {
        $questionModel = new Application_Model_Question();
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
            'label' => 'First Name',
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
            'label' => 'Last Name',
            'id' => 'default'
        );

        //name    
        $options['description'] = FALSE;
        $options['id'] = "fname";
        $this->addElement('text', 'fname', $options);
        //$this->getElement('name')->setAttrib('id', 'name');
        //lname    
        $options['description'] = FALSE;
        $options['id'] = "lname";
        $this->addElement('text', 'lname', $options);

        //Email
        $options['label'] = 'Email';
        $options['id'] = 'email';
        $options['description'] = FALSE;
        $this->addElement('text', 'email', $options);
        $this->getElement('email')->addValidator($emailValidate);

        //address
        $options['label'] = 'Address';
        $options['id'] = 'address';
        $options['description'] = FALSE;
        $this->addElement('text', 'address', $options);

        //address 1
        $options['label'] = 'Address 1';
        $options['id'] = 'address1';
        $options['description'] = FALSE;
        $options['required'] = FALSE;
        $this->addElement('text', 'address1', $options);
        $this->getElement('address1')->addValidator($notEmpty);


        $selectbox['label'] = 'Country';
        $selectbox['id'] = 'country';
        $selectbox['description'] = FALSE;
        $this->addElement('select', 'country', $selectbox);

        $question = $questionModel->fetchAll($where = 'questionType=0');

        foreach ($question as $key) {
            $questionid = $key['question'];

            $selectbox['label'] = $key['question'];
            $selectbox['id'] = $key['questionType'] . '' . $key['Id'];
            $selectbox['description'] = FALSE;
            $this->addElement('select', $selectbox['id'], $selectbox);
        }


        /*
          $selectbox['label'] = 'How much have your skills improved because of the training at the Forum?';
          $selectbox['id'] = 'skills';
          $selectbox['description'] = FALSE;
          $this->addElement('select', 'skills', $selectbox);

          $selectbox['label'] = 'Overall, were you satisfied with the Forum, neither satisfied nor dissatisfied with it, or dissatisfied with it?';
          $selectbox['id'] = 'satisfaction';
          $selectbox['description'] = FALSE;
          $this->addElement('select', 'satisfaction', $selectbox);

          $selectbox['label'] = 'Was the Forum better than what you expected, worse than what you expected, or about what you expected?';
          $selectbox['id'] = 'expectation';
          $selectbox['description'] = FALSE;
          $this->addElement('select', 'expectation', $selectbox);

          $selectbox['label'] = 'How useful was the information presented at the Forum?';
          $selectbox['id'] = 'presentation';
          $selectbox['description'] = FALSE;
          $this->addElement('select', 'presentation', $selectbox);

         * */
    }

}

