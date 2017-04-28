<?php
/**
 * Created by PhpStorm.
 * User: dckap
 * Date: 22/3/17
 * Time: 3:50 PM
 */

namespace Training\RetailerAdmin\Block\Adminhtml\Retailer\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class ResetButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label'   =>  __('Reset'),
            'on_click'  =>  sprintf("location.reload();"),
            'class' =>  'reset',
            'sort_order'    =>  30
        ];
    }
}