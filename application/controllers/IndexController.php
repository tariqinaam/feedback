<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        

        // action body
        $form = new Application_Form_Feedback();
        $this->view->form = $form;
        
        $questionModel = new Application_Model_Question();
        $question = $questionModel->fetchAll($where='isActive=1');
        $indexmodel = new Application_Model_Feedback;
        
        foreach ($question as $key ) {
          $questionid =  $key['Id'];
         }
         
         $answers = $indexmodel->fetchAll($where='questionId=1');
            foreach ($answers as $key) {
            $form->getElement('skills')
                    ->addMultiOptions(array($key['Id'] => $key['answer']));
        }
        
        $answers1 = $indexmodel->fetchAll($where='questionId=2');
            foreach ($answers1 as $key) {
            $form->getElement('satisfaction')
                    ->addMultiOptions(array($key['Id'] => $key['answer']));
        }
        
        
        $answers = $indexmodel->fetchAll($where='questionId=3');
            foreach ($answers as $key) {
            $form->getElement('expectation')
                    ->addMultiOptions(array($key['Id'] => $key['answer']));
        }
        
         $answers = $indexmodel->fetchAll($where='questionId=4');
            foreach ($answers as $key) {
            $form->getElement('presentation')
                    ->addMultiOptions(array($key['Id'] => $key['answer']));
        }
        
         
       
        $result = $indexmodel->getCountries();
        foreach ($result as $key => $value) {
            $form->getElement('country')
                    ->addMultiOptions(array($key => $value));
        }
        
        
        


        if ($this->getRequest()->isPost()) {
            if ($this->view->form->isValid($_POST)) {
                // process data here
            } else {
                $this->view->errormessage = "errors on form, please check";
                $this->view->form->populate($_POST);
            }
        }
    }

}

