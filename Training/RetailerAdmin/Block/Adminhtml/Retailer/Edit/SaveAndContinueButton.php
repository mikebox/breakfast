<?php
/**
 * Created by PhpStorm.
 * User: dckap
 * Date: 22/3/17
 * Time: 3:50 PM
 */

namespace Training\RetailerAdmin\Block\Adminhtml\Retailer\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveAndContinueButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label'   =>  __('Save And Continue Edit'),
            'data_attribute'  =>  [
                'mage-init' => ['button' => ['event' => 'saveAndContinueEdit']],
            ],
            'class' =>  'save',
            'sort_order' =>  80
        ];
    }
}