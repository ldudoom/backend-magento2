<?php
namespace Buhoo\ModuloBasico\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Buhoo extends Template
{
    public function __construct(Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }
}
