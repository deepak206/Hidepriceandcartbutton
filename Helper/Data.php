<?php
namespace Magegeeks\Hidepriceandcartbutton\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_session;
    protected $_scopeConfig;

    public function __construct(
        \Magento\Customer\Model\Session $session,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->_session = $session;
        $this->_scopeConfig = $scopeConfig;
    }

    /*
    * @return string
    */
    public function getConfig($config_path)
    {
        return $this->_scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /*
    * @return bool
    */
    public function isLoggedIn()
    {
        return $this->_session->isLoggedIn();
    }
}
