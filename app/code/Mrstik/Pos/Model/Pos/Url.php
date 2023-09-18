<?php

namespace Mrstik\Pos\Model\Pos;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\ScopeInterface;
use Mrstik\Pos\Model\Pos;

class Url
{
    const LIST_URL_CONFIG_PATH = 'mrstik_pos/pos/list_url';

    const URL_PREFIX_CONFIG_PATH = 'mrstik_pos/pos/url_prefix';

    const URL_SUFFIX_CONFIG_PATH = 'mrstik_pos/pos/url_suffix';

    protected $urlBuilder;

    protected $scopeConfig;

    public function __construct(
        UrlInterface $urlBuilder,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->scopeConfig = $scopeConfig;
    }

    public function getListUrl()
    {
        $sefUrl = $this->scopeConfig->getValue(self::LIST_URL_CONFIG_PATH, ScopeInterface::SCOPE_STORE);
        if ($sefUrl) {
            return $this->urlBuilder->getUrl('', ['_direct' => $sefUrl]);
        }
        return $this->urlBuilder->getUrl('mrstik_pos/pos/index');
    }

    public function getPosUrl(Pos $pos)
    {
        return $this->urlBuilder->getUrl('mrstik_pos/pos/view', ['id' => $pos->getId()]);
    }
}
