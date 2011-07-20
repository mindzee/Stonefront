<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public $frontController;
    
    protected $_logger;
    
    public function _initLogging()
    {
        $this->bootstrap('frontController');
        
        $logger = new Zend_Log();
        
        if ('production' == $this->getEnvironment())
        {
            $writer = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/../data/logs/app.log');
        }
        else
        {
            $writer = new Zend_Log_Writer_Firebug();
        }
        
        $logger->addWriter($writer);
        
        if ('production' == $this->getEnvironment())
        {
            $filter = new Zend_Log_Filter_Priority(Zend_Log::CRIT);
            
            $logger->addFilter($filter);
        }
        
        $this->_logger = $logger;
        
        Zend_Registry::set('log', $logger);
    }
    
    protected function _initLocale()
    {
        $this->_logger->info('Bootstrap' . __METHOD__);
        
        Zend_Registry::set('Zend_Locale', new Zend_Locale('lt_LT'));
    }
    
    protected function _initViewSettings()
    {
        $this->_logger->info('Bootstrap' . __METHOD__);
        
        $this->bootstrap('view');
        
        // Gaunamas view resursas
        $view = $this->getResource('view');
        
        // HTML koduote nustatoma i utf-8
        $view->setEncoding('UTF-8');
        
        // Doctype nustatomas i STRICT
        $view->doctype('XHTML1_STRICT');
        
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=utf-8');
        $view->headMeta()->appendHttpEquiv('Content-Language', 'en_US');
        
        // Prijungiami CSS failai
        $view->headStyle()->setStyle('@import "/css/access.css";');
        $view->headLink()->appendStylesheet('/css/reset.css');
        $view->headLink()->appendStylesheet('/css/main.css');
        $view->headLink()->appendStylesheet('css/form.css');
        
        //Nustatomas puslapio pavadinimas
        $view->headTitle('Stonefront');
        
        // Nustatomas skiriamasis pavadinimo teksto skiriamasis zenklas
        $view->headTitle()->setSeparator(' - ');
    }
    
    protected function _initDbProfiler()
    {
        $this->_logger->info('Bootstrap' . __METHOD__);
        
        if ('production' !== $this->getEnvironment())
        {
            $this->bootstrap('db');
            
            $profiler = new Zend_Db_Profiler_Firebug('All DB Queries');
            $profiler->setEnabled(true);
            
            $this->getPluginResource('db')
                     ->getDbAdapter()
                     ->setProfiler($profiler);
        }
    }
}