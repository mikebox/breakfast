<?php
/**
 * Created by PhpStorm.
 * User: dckap
 * Date: 20/3/17
 * Time: 4:43 PM
 */

namespace Training\RetailerAdmin\Ui\Component\Listing\Column;


use Magento\Framework\UrlInterface;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

class RetailerActions extends Column
{
    const RETAILER_PATH_EDIT = "retaileradmin/retailer/edit";
    const RETAILER_PATH_DELETE = "retaileradmin/retailer/delete";

    private $urlBuilder;

    private $editUrl;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components,
        array $data,
        $editUrl = self::RETAILER_PATH_EDIT
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->editUrl = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['id'])) {
                    $item[$name]['edit'] = [
                        'href'  => $this->urlBuilder->getUrl(self::RETAILER_PATH_EDIT, ['id' => $item['id']]),
                        'label' => __('Edit')
                    ];
                    $item[$name]['delete'] = [
                        'href'  => $this->urlBuilder->getUrl(self::RETAILER_PATH_DELETE, ['id' => $item['id']]),
                        'label' => __('Delete'),
                        'confirm'   =>  [
                            'title' =>  __('Delete ${ $.$data.id }'),
                            'message'   =>  __('Are you sure you wan\'t to delete a ${ $.$data.id } record?')
                        ]
                    ];

                }
            }
        }

        return $dataSource;
    }
}