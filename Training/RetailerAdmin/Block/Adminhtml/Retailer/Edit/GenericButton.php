<?php
namespace Training\RetailerAdmin\Block\Adminhtml\Retailer\Edit;

use Training\RetailerRepo\Api\RetailerRepositoryInterface;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

class GenericButton
{
    private $retailerRepository;

    public function __construct(
        Context $context,
        RetailerRepositoryInterface $retailerRepository
    ) {
        $this->context = $context;
        $this->retailerRepository = $retailerRepository;
    }

    public function getId()
    {
        try {
            return $this->retailerRepository->getById($this->context->getRequest()->getParam('id'))->getId();
        } catch (NoSuchEntityException $e) {

        }

        return null;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}