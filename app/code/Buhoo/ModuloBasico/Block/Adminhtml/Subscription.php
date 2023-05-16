<?php

namespace Buhoo\ModuloBasico\Block\Adminhtml;

class Subscription extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'Buhoo_ModuloBasico';
        $this->_controller = 'adminhtml_subscription';
        //$this->_headerText = __('Elemnto Marco');
        //$this->_addButtonLabel = __('Add News');
        parent::_construct();
    }
}
