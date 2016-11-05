<?php
namespace Magegeeks\Hidepriceandcartbutton\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
	/*
    * @return string
    */
    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /*
    * @return bool
    */
   	public function isLoggedIn()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$context = $objectManager->get('Magento\Framework\App\Http\Context');
		return $context->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
    }
}