<?php

namespace Mrstik\Pos\Controller\Adminhtml\Pos;

use Mrstik\Pos\Controller\Adminhtml\Pos;
use Mrstik\Pos\Controller\RegistryConstants;

class Edit extends Pos
{
    protected function _initPos()
    {
        $posId = $this->getRequest()->getParam('pos_id');
        $this->coreRegistry->register(RegistryConstants::CURRENT_POS_ID, $posId);

        return $posId;
    }
    public function execute()
    {
        $posId = $this->_initPos();

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Mrstik_Pos::pos');
        $resultPage->getConfig()->getTitle()->prepend(__('Points of Sale'));
        $resultPage->addBreadcrumb(__('Points of Sale'), __('Points of Sale'));
        $resultPage->addBreadcrumb(__('Manage Points of Sale'), __('Manage Points of Sale'), $this->getUrl('mrstik_pos/pos'));

        if ($posId === null) {
            $resultPage->addBreadcrumb(__('New Point of Sale'), __('New Point of Sale'));
            $resultPage->getConfig()->getTitle()->prepend(__('New Point of Sale'));
        } else {
            $resultPage->addBreadcrumb(__('Edit Point of Sale'), __('Edit Point of Sale'));
            $resultPage->getConfig()->getTitle()->prepend($this->posRepository->getById($posId)->getName());
        }
        return $resultPage;
    }
}
