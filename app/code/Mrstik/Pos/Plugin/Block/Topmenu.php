<?php

namespace Mrstik\Pos\Plugin\Block;

use Magento\Framework\App\Request\Http;
use Magento\Framework\Data\Tree\Node;
use Magento\Theme\Block\Html\Topmenu as TopmenuBlock;
use Mrstik\Pos\Model\Pos\Url;

class Topmenu
{
    protected $url;

    protected $request;

    public function __construct(
        Url $url,
        Http $request
    ) {
        $this->url      = $url;
        $this->request  = $request;
    }

    /**
     * @SuppressWarnings("PMD.UnusedFormalParameter")
     */
    // @codingStandardsIgnoreStart
    public function beforeGetHtml(
        TopmenuBlock $subject,
        $outermostClass = '',
        $childrenWrapClass = '',
        $limit = 0
    ) {
        // @codingStandardsIgnoreEnd
        $node = new Node(
            $this->getNodeAsArray(),
            'id',
            $subject->getMenu()->getTree(),
            $subject->getMenu()
        );
        $subject->getMenu()->addChild($node);
    }

    protected function getNodeAsArray()
    {
        return [
            'name' => __('Points of Sale'),
            'id' => 'pos-node',
            'url' => $this->url->getListUrl(),
            'has_active' => false,
            'is_active' => in_array($this->request->getFullActionName(), $this->getActiveHandles())
        ];
    }

    protected function getActiveHandles()
    {
        return [
            'mrstik_pos_pos_index',
            'mrstik_pos_pos_view'
        ];
    }
}
