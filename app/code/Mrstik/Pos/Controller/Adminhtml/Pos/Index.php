<?php
namespace Mrstik\Pos\Controller\Adminhtml\Pos;

use \Mrstik\Pos\Controller\Adminhtml\Pos as PosController;

class Index extends PosController
{
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Mrstik_Pos::pos');
        $resultPage->getConfig()->getTitle()->prepend(__('Points of Sale'));
        $resultPage->addBreadcrumb(__('Points of Sale'), __('Points of Sale'));
        $resultPage->addBreadcrumb(__('Manage Points of Sale'), __('Manage Points of Sale'));
        return $resultPage;
    }
}
