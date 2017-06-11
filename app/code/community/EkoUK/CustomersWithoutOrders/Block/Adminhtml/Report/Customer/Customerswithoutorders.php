<?php

class EkoUK_CustomersWithoutOrders_Block_Adminhtml_Report_Customer_Customerswithoutorders extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_blockGroup = 'customerswithoutorders';
        $this->_controller = 'adminhtml_report_customer_customerswithoutorders';
        $this->_headerText = Mage::helper('reports')->__('Customers without orders');
        parent::__construct();

        $this->_removeButton('add');
    }

}
