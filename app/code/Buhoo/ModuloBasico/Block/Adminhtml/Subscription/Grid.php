<?php

namespace Buhoo\ModuloBasico\Block\Adminhtml\Subscription;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;
use Magento\Backend\Block\Widget\Grid\Extended;

use Buhoo\ModuloBasico\Model\ResourceModel\Subscription\Collection;


class Grid extends Extended
{
    protected Collection $_subscriptionCollection;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Buhoo\ModuloBasico\Model\ResourceModel\Subscription\Collection $subscriptionCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Buhoo\ModuloBasico\Model\ResourceModel\Subscription\Collection $subscriptionCollection,
        array $data = []
    ){
        $this->_subscriptionCollection = $subscriptionCollection;
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
        $this->setCollection($this->_subscriptionCollection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare columns
     *
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'subscription_id',
            [
                'header' => __('ID'),
                'index' => 'subscription_id'
            ]
        );

        $this->addColumn(
            'firstname',
            [
                'header' => __('FIRSTNAME'),
                'index' => 'firstname'
            ]
        );

        $this->addColumn(
            'lastname',
            [
                'header' => __('LASTNAME'),
                'index' => 'lastname'
            ]
        );

        $this->addColumn(
            'email',
            [
                'header' => __('EMAIL'),
                'index' => 'email'
            ]
        );

        $this->addColumn(
            'status',
            [
                'header' => __('STATUS'),
                'index' => 'status',
                'frame_callback' => [$this, 'decorateStatus']
            ]
        );

        return $this;
    }

    public function decorateStatus($value): string
    {
        $class = '';
        switch ($value){
            case 'pending':
                $class = 'grid-severity-minor';
                break;
            case 'approved':
                $class = 'grid-severity-notice';
                break;
            case 'declined':
                $class = 'grid-severity-critical';
                break;
        }
        return '<span class="' . $class . '"><span>' . $value . '</span></span>';
    }
}
