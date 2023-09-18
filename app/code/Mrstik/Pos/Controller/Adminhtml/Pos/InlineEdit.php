<?php

namespace Mrstik\Pos\Controller\Adminhtml\Pos;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\Session;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime\Filter\Date;
use Magento\Framework\View\Result\PageFactory;
use Mrstik\Pos\Api\PosRepositoryInterface;
use Mrstik\Pos\Api\Data\PosInterface;
use Mrstik\Pos\Api\Data\PosInterfaceFactory;
use Mrstik\Pos\Controller\Adminhtml\Pos as PosController;
use Mrstik\Pos\Model\Pos;
use Mrstik\Pos\Model\ResourceModel\Pos as PosResourceModel;

class InlineEdit extends PosController
{
    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $jsonFactory;

    protected $posResourceModel;

    public function __construct(
        Registry $registry,
        PosRepositoryInterface $posRepository,
        PageFactory $resultPageFactory,
        Date $dateFilter,
        Context $context,
        DataObjectProcessor $dataObjectProcessor,
        DataObjectHelper $dataObjectHelper,
        JsonFactory $jsonFactory,
        PosResourceModel $posResourceModel
    )
    {
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->jsonFactory = $jsonFactory;
        $this->posResourceModel = $posResourceModel;
        parent::__construct($registry, $posRepository, $resultPageFactory, $dateFilter, $context);
    }

    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }

        foreach (array_keys($postItems) as $posId) {
            $pos = $this->posRepository->getById((int)$posId);
            try {
                $posData = $this->filterData($postItems[$posId]);
                $this->dataObjectHelper->populateWithArray($pos, $posData , PosInterface::class);
                $this->posResourceModel->saveAttribute($pos, array_keys($posData));
            } catch (LocalizedException $e) {
                $messages[] = $this->getErrorWithPosId($pos, $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithPosId($pos, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithPosId(
                    $pos,
                    __('Something went wrong while saving the Point of Sale.')
                );
                $error = true;
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    protected function getErrorWithPosId(Pos $pos, $errorText)
    {
        return '[PoS ID: ' . $pos->getId() . '] ' . $errorText;
    }
}
