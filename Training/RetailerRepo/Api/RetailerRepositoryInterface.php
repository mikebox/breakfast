<?php

namespace Training\RetailerRepo\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface RetailerRepositoryInterface
{
    /**
     * @param int $id
     * @return \Training\RetailerRepo\Api\Data\RetailerInterface
     */
    public function getById($id);

    /**
     * @param \Training\RetailerRepo\Api\Data\RetailerInterface $retailer
     * @return \Training\RetailerRepo\Api\Data\RetailerInterface
     */
    public function save(Data\RetailerInterface $retailer);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Training\RetailerRepo\Api\Data\RetailerSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param $id
     * @return bool
     */
    public function delete($id);
}