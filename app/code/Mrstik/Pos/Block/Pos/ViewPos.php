<?php

namespace Mrstik\Pos\Block\Pos;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class ViewPos extends Template
{
    protected $coreRegistry;

    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    public function getCurrentPos()
    {
        return $this->coreRegistry->registry('current_pos');
    }
}
