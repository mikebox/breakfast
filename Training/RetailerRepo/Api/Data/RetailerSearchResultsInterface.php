<?php

namespace Training\RetailerRepo\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface RetailerSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get items list.
     *
     * @return \Training\RetailerRepo\Api\Data\RetailerInterface[]
     */
    public function getItems();

    /**
     * Set items list.
     *
     * @param \Training\RetailerRepo\Api\Data\RetailerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}