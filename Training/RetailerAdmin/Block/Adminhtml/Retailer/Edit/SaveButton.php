<?php
/**
 * Created by PhpStorm.
 * User: dckap
 * Date: 22/3/17
 * Time: 3:50 PM
 */

namespace Training\RetailerAdmin\Block\Adminhtml\Retailer\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label'   =>  __('Save'),
            'data_attribute'  =>  [
                'mage-init' =>  ['button' => ['event' => 'save']],
                'form-role' =>  'save'
            ],
            'class' =>  'save primary',
            'sort_order'    =>  90
        ];
    }
}