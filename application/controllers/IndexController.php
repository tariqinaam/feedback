<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        switch ($qId) {
            case 1:
                $id=1;

                break;

            default:
                break;
        }

        // action body
        $form = new Application_Form_Feedback();
        $this->view->form = $form;

        $indexmodel = new Application_Model_Feedback;
        
        $result = $indexmodel->getCountries();
        foreach ($result as $key => $value) {
            $form->getElement('country')
                    ->addMultiOptions(array($key => $value));
        }
        $questionId= 1;
        $answers = $indexmodel->fetchAll($where='questionId=1');
        
        foreach ($answers as $key) {
            echo $key['Id'];
            $form->getElement('skills')
                    ->addMultiOptions(array($key['Id'] => $key['answer']));
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

