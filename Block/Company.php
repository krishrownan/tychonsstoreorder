<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Tychons\Storeorder\Block;

use Magento\Customer\Block\Account\SortLinkInterface;

/**
 * Front end helper block to add links
 *
 * @api
 * @since 100.0.2
 */
class Company extends \Magento\Framework\View\Element\Html\Link\Current implements SortLinkInterface
{
    
    /**
     * {@inheritdoc}
     */
    protected function _toHtml()
    {
        if (false != $this->getTemplate()) {
            return parent::_toHtml();
        }
        return '<li><a ' . $this->getLinkAttributes() . ' >' . $this->escapeHtml($this->getLabel()) . '</a></li>';
    }
}
