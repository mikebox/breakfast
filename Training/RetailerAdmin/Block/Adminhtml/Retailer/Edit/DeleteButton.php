<?php
/**
 * Created by PhpStorm.
 * User: dckap
 * Date: 22/3/17
 * Time: 3:50 PM
 */

namespace Training\RetailerAdmin\Block\Adminhtml\Retailer\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];

        if($this->getId()) {
            $data = [
                'label'   =>  __('Delete'),
                'on_click'  =>  'deleteConfirm("'.__('Are you sure you want to do this?').'","'.$this->getDeleteUrl().'")',
                'class' =>  'delete',
                'sort_order'    =>  10
            ];
        }

        return $data;
    }

    private function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['id'   =>  $this->getId() ]);
    }
}