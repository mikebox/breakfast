<?php
namespace Training\Retailers\Model\ResourceModel\Retailer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Training\Retailers\Model\ResourceModel\Retailer;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Training\Retailers\Model\Retailer', 'Training\Retailers\Model\ResourceModel\Retailer');
    }

    public function addFilterByProduct($productId)
    {
        $productId = (int) $productId;

        $this->getSelect()->join(
            ['r2p'  =>  Retailer::ENTITY_PRODUCT_TABLE],
            "`main_table`.id = `r2p`.retailer_id AND `r2p`.product_id = $productId"
        );

        return $this;
    }
}