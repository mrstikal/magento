<?php
namespace Mrstik\Pos\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime\Filter\Date;
use Magento\Framework\View\Result\PageFactory;
use Mrstik\Pos\Api\PosRepositoryInterface;

abstract class Pos extends Action
{
    const ACTION_RESOURCE = 'Mrstik_Pos::pos';

    protected $posRepository;

    protected $coreRegistry;

    protected $dateFilter;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    public function __construct(
        Registry $registry,
        PosRepositoryInterface $posRepository,
        PageFactory $resultPageFactory,
        Date $dateFilter,
        Context $context

    ) {
        $this->coreRegistry      = $registry;
        $this->posRepository  = $posRepository;
        $this->resultPageFactory = $resultPageFactory;
        $this->dateFilter        = $dateFilter;
        parent::__construct($context);
    }

    public function filterData($data)
    {
        return $data;
    }


}
