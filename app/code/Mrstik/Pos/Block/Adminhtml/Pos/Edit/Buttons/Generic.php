<?php
namespace Mrstik\Pos\Block\Adminhtml\Pos\Edit\Buttons;

use Magento\Backend\Block\Widget\Context;
use Mrstik\Pos\Api\PosRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Generic
{
    protected $context;

    protected $posRepository;


    public function __construct(
        Context $context,
        PosRepositoryInterface $posRepository
    ) {
        $this->context = $context;
        $this->posRepository = $posRepository;
    }

    public function getPosId()
    {
        try {
            return $this->posRepository->getById(
                $this->context->getRequest()->getParam('pos_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
