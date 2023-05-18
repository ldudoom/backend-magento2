<?php

namespace Buhoo\ModuloBasico\Model\ResourceModel\Subscription;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init('Buhoo\ModuloBasico\Model\Subscription', 'Buhoo\ModuloBasico\Model\ResourceModel\Subscription');
    }
}
