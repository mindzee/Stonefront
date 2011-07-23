<?php

class Stonefront_ErrorController extends Zend_Controller_Action
{
    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
        
        switch ($errors->type)
        {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error
                $this->getResponse()->setHttpResponseCode(404);
                $this->view->message = '404 Page Not Found';
                break;
                
            case SF_Exception_404:
                // 404 error
                $this->getResponse()->setHttpResponseCode(404);
                $this->view->message = $errors->exception->getMessage();
                break;
                
           default:
               // application error
               $this->getResponse()->setHttpResponseCode(500);
               $this->view->message = $errors->exception->getMessage();
               break;
        }
    }
}