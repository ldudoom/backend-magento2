<?php

namespace Buhoo\ModuloBasico\Block\Adminhtml\Subscription;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;
use Magento\Backend\Block\Widget\Grid\Extended;

//use Buhoo\ModuloBasico\Model\Resource\Subscription\Collection;


class Grid extends Extended
{
    //protected Collection $_subscriptionCollection;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
    // * @param \Buhoo\ModuloBasico\Model\ResourceModel\Subscription\Collection $subscriptionCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
      //  \Buhoo\ModuloBasico\Model\ResourceModel\Subscription\Collection $subscriptionCollection,
        array $data = []
    ){

        //echo "oso";exit;
       // $this->_subscriptionCollection = $subscriptionCollection;
        parent::__construct($context, $backendHelper, $data);
        $this->setEmptyText(__('No Subscription Found'));
    }

    /**
     * Initialize the subscription collection
     *
     * @return WidgetGrid
     */
    protected function _prepareCollection()
    {
        //$this->setCollection($this->_subscriptionCollection);
        return parent::_prepareCollection();
    }
}
