<?php

namespace Mrstik\Pos\Controller\Adminhtml\Pos;

use Magento\Backend\Model\Session;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime\Filter\Date;
use Magento\Framework\View\Result\PageFactory;
use Mrstik\Pos\Api\PosRepositoryInterface;
use Mrstik\Pos\Api\Data\PosInterface;
use Mrstik\Pos\Api\Data\PosInterfaceFactory;
use Mrstik\Pos\Controller\Adminhtml\Pos;

class Save extends Pos
{
    protected $dataObjectProcessor;

    protected $dataObjectHelper;

    public function __construct(
        Registry $registry,
        PosRepositoryInterface $posRepository,
        PageFactory $resultPageFactory,
        Date $dateFilter,
        Context $context,
        PosInterfaceFactory $posFactory,
        DataObjectProcessor $dataObjectProcessor,
        DataObjectHelper $dataObjectHelper
    )
    {
        $this->posFactory = $posFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($registry, $posRepository, $resultPageFactory, $dateFilter, $context);
    }

    public function execute()
    {
        $pos = null;
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['pos_id']) ? $data['pos_id'] : null;
        $resultRedirect = $this->resultRedirectFactory->create();
        try {
            if ($id) {
                $pos = $this->posRepository->getById((int)$id);
            } else {
                unset($data['pos_id']);
                $pos = $this->posFactory->create();
            }
            $this->dataObjectHelper->populateWithArray($pos, $data, PosInterface::class);
            $this->posRepository->save($pos);
            $this->messageManager->addSuccessMessage(__('You saved the Point of Sale'));
            if ($this->getRequest()->getParam('back')) {
                $resultRedirect->setPath('mrstik_pos/pos/edit', ['pos_id' => $pos->getId()]);
            } else {
                $resultRedirect->setPath('mrstik_pos/pos');
            }
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            if ($pos != null) {
                $this->storePosDataToSession(
                    $this->dataObjectProcessor->buildOutputDataArray(
                        $pos,
                        PosInterface::class
                    )
                );
            }
            $resultRedirect->setPath('mrstik_pos/pos/edit', ['pos_id' => $id]);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('There was a problem saving the Point of Sale'));
            if ($pos != null) {
                $this->storePosDataToSession(
                    $this->dataObjectProcessor->buildOutputDataArray(
                        $pos,
                        PosInterface::class
                    )
                );
            }
            $resultRedirect->setPath('mrstik_pos/pos/edit', ['pos_id' => $id]);
        }
        return $resultRedirect;
    }

    /**
     * @param $posData
     */
    protected function storePosDataToSession($posData)
    {
        $this->_getSession()->setMrstikPosPosData($posData);
    }
}
