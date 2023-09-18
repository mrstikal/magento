<?php

namespace Mrstik\Pos\Controller\Adminhtml\Pos;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Mrstik\Pos\Controller\Adminhtml\Pos;

class Delete extends Pos
{
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('pos_id');
        if ($id) {
            try {
                $this->posRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('The Point of Sale has been deleted.'));
                $resultRedirect->setPath('mrstik_pos/*/');
                return $resultRedirect;
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('The Point of Sale no longer exists.'));
                return $resultRedirect->setPath('mrstik_pos/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('mrstik_pos/pos/edit', ['pos_id' => $id]);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('There was a problem deleting the Point of Sale'));
                return $resultRedirect->setPath('mrstik_pos/pos/edit', ['pos_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a Point of Sale to delete.'));
        $resultRedirect->setPath('mrstik_pos/*/');
        return $resultRedirect;
    }
}
