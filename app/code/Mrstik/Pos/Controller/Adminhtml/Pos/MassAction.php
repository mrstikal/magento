<?php
namespace Mrstik\Pos\Controller\Adminhtml\Pos;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime\Filter\Date;
use Magento\Framework\View\Result\PageFactory;
use Magento\Ui\Component\MassAction\Filter;
use Mrstik\Pos\Api\PosRepositoryInterface;
use Mrstik\Pos\Controller\Adminhtml\Pos;
use Mrstik\Pos\Model\Pos as PosModel;
use Mrstik\Pos\Model\ResourceModel\Pos\CollectionFactory;

abstract class MassAction extends Pos
{
    protected $filter;

    protected $collectionFactory;

    protected $successMessage;

    protected $errorMessage;

    public function __construct(
        Registry $registry,
        PosRepositoryInterface $posRepository,
        PageFactory $resultPageFactory,
        Date $dateFilter,
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        $successMessage,
        $errorMessage
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->successMessage = $successMessage;
        $this->errorMessage = $errorMessage;
        parent::__construct($registry, $posRepository, $resultPageFactory, $dateFilter, $context);
    }

    protected abstract function massAction(PosModel $pos);

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $collection->getSize();
            foreach ($collection as $pos) {
                $this->massAction($pos);
            }
            $this->messageManager->addSuccessMessage(__($this->successMessage, $collectionSize));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __($this->errorMessage));
        }
        $redirectResult = $this->resultRedirectFactory->create();
        $redirectResult->setPath('mrstik_pos/*/index');
        return $redirectResult;
    }
}
