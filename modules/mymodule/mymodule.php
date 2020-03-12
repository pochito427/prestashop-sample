<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class MyModule extends Module
{

    public function __construct()
    {
        $this->name = 'mymodule';
        $this->tab = 'others';
        $this->version = '1.0.0';
        $this->author = 'Alfonso Jimenez';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.7',
            'max' => _PS_VERSION_
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('My first custom module developed for Prestashop 1.7');
        $this->description = $this->l('A custom module created for learning and training purposes on GradiWeb job.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        /*if (!Configuration::get('MYMODULE_NAME')) {
            $this->warning = $this->l('No name provided');
        }*/
    }

    /**
     * @return bool
     * @throws PrestaShopException
     */

    public function install()
    {

        /**
         * Check that the Multistore feature is enabled, and if so, set the current context
         * to all shops on this installation of PrestaShop.
         */

       if (Shop::isFeatureActive()) {
          Shop::setContext(Shop::CONTEXT_ALL);
       }

       /**
        * Check that the module parent class is installed.
        * Check that the module can be attached to the leftColumn hook.
        * Check that the module can be attached to the header hook.
        * Check the MYMODULE_NAME configuration setting, seeting its value to "my friend".
        */
    
       if (!parent::install() ||
        !$this->registerHook('leftColumn') ||
        !$this->registerHook('header') ||
        !Configuration::updateValue('MYMODULE_NAME', 'my friend')
       ) {
           return false;
       }
    
       return true;
    }

    /**
     * @return bool
     */

    public function uninstall()
    {

       /**
        * Delete the data added to the database during the installation.    
        */ 
       if (!parent::uninstall() ||
           !Configuration::deleteByName('MYMODULE_NAME')
       ) {
           return false;
       }

       return true;
    }




}