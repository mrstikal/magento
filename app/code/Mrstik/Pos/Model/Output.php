<?php
namespace Mrstik\Pos\Model;

class Output
{
    protected $templateProcessor;

    public function __construct(
        \Zend_Filter_Interface $templateProcessor
    ) {
        $this->templateProcessor = $templateProcessor;
    }

    public function filterOutput($string)
    {
        return $this->templateProcessor->filter($string);
    }
}
