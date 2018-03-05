<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magegeeks\Hidepriceandcartbutton\Pricing;

use Magento\Catalog\Model\Product;
use Magento\Framework\Pricing\SaleableInterface;
use Magento\Framework\Pricing\Render as PricingRender;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

/**
 * Catalog Price Render
 *
 * @method string getPriceRender()
 * @method string getPriceTypeCode()
 */
class Render extends Template
{
    /**
     * @var \Magento\Framework\Registry
     */
    public $registry;

    public $helper;
    /**
     * Construct
     *
     * @param Template\Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Registry $registry,
        \Magegeeks\Hidepriceandcartbutton\Helper\Data $helper,
        array $data = []
    ) {
        $this->registry = $registry;
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * Produce and return block's html output
     *
     * @return string
     */
    public function _toHtml()
    {
        /** @var PricingRender $priceRender */
        $priceRender = $this->getLayout()->getBlock($this->getPriceRender());
        if ($priceRender instanceof PricingRender) {
            $product = $this->getProduct();
            if ($product instanceof SaleableInterface) {
                $arguments = $this->getData();
                $arguments['render_block'] = $this;

                $status = $this->helper->getConfig('hidepriceandcartbutton/configuration/enable');
                $priceText = $this->helper->getConfig('hidepriceandcartbutton/configuration/pricetext');
                $isLoggedIn = $this->helper->isLoggedIn();
                if ($status && !$isLoggedIn) {
                    return $priceText;
                } else {
                    return $priceRender->render($this->getPriceTypeCode(), $product, $arguments);
                }
            }
        }
        return parent::_toHtml();
    }

    /**
     * Returns saleable item instance
     *
     * @return Product
     */
    public function getProduct()
    {
        $parentBlock = $this->getParentBlock();

        $product = $parentBlock && $parentBlock->getProductItem()
            ? $parentBlock->getProductItem()
            : $this->registry->registry('product');
        return $product;
    }
}
