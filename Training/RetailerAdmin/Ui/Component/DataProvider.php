<?php

namespace Training\RetailerAdmin\Ui\Component;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\RequestInterface;

class DataProvider extends \Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider
{
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ReportingInterface $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        $meta = [],
        $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $reporting, $searchCriteriaBuilder, $request,
            $filterBuilder, $meta, $data);
    }

    public function getData()
    {
        return $this->generateOutputArray($this->getSearchResult());
    }

    private function generateOutputArray($collection) {
        $data = ['totalRecords' => $collection->getSize(), 'items'  => []];
        foreach ($collection as $item) {
            $data['items'][] = $item->getData();
        }

        return $data;
    }
}