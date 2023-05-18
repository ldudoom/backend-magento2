<?php

namespace Buhoo\ModuloBasico\Model\ResourceModel;

class Subscription extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('buhoo_subscription', 'subscription_id');
    }
}
