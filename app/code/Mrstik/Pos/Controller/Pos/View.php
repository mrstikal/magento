<?php
namespace Mrstik\Pos\Controller\Pos;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Model\ScopeInterface;
use Mrstik\Pos\Api\PosRepositoryInterface;
use Mrstik\Pos\Model\Pos\Url as UrlModel;

class View extends Action
{
    const BREADCRUMBS_CONFIG_PATH = 'mrstik_pos/pos/breadcrumbs';

    protected $posRepository;

    protected $resultForwardFactory;

    protected $resultPageFactory;

    protected $coreRegistry;

    protected $urlModel;

    protected $scopeConfig;

    public function __construct(
        Context $context,
        PosRepositoryInterface $posRepository,
        ForwardFactory $resultForwardFactory,
        PageFactory $resultPageFactory,
        Registry $coreRegistry,
        UrlModel $urlModel,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        $this->posRepository     = $posRepository;
        $this->resultPageFactory    = $resultPageFactory;
        $this->coreRegistry         = $coreRegistry;
        $this->urlModel             = $urlModel;
        $this->scopeConfig          = $scopeConfig;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $posId = (int)$this->getRequest()->getParam('id');
            $pos = $this->posRepository->getById($posId);

            if (!$pos->getIsActive()) {
                throw new \Exception();
            }
        } catch (\Exception $e){
            $resultForward = $this->resultForwardFactory->create();
            $resultForward->forward('noroute');
            return $resultForward;
        }

        $this->coreRegistry->register('current_pos', $pos);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set($pos->getName());
        if ($this->scopeConfig->isSetFlag(self::BREADCRUMBS_CONFIG_PATH, ScopeInterface::SCOPE_STORE)) {
            $breadcrumbsBlock = $resultPage->getLayout()->getBlock('breadcrumbs');
            if ($breadcrumbsBlock) {
                $breadcrumbsBlock->addCrumb(
                    'home',
                    [
                        'label' => __('Home'),
                        'link'  => $this->_url->getUrl('')
                    ]
                );
                $breadcrumbsBlock->addCrumb(
                    'pos',
                    [
                        'label' => __('Points Of Sale'),
                        'link' => $this->urlModel->getListUrl()
                    ]
                );
                $breadcrumbsBlock->addCrumb(
                    'pos-'.$pos->getId(),
                    [
                        'label' => $pos->getName()
                    ]
                );
            }
        }

        return $resultPage;
    }
}
