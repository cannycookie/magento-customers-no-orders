<?php
class EkoUK_CustomersWithoutOrders_Model_Mysql4_Customerswithoutorders_Collection extends Mage_Customer_Model_Resource_Customer_Collection
{
    /**
     * Resource initialization
     */
    protected function _construct()
    {
        $this->_init('customer/customer');
    }

    protected function _initSelect()
    {
        parent::_initSelect();
        $this->addNameToSelect();
        $this->joinAttribute('billing_telephone', 'customer_address/telephone', 'default_billing', null, 'left')
            ->joinAttribute('billing_country_id', 'customer_address/country_id', 'default_billing', null, 'left');
        $this->getSelect()->joinLeft(
            array('o' => Mage::getSingleton('core/resource')->getTableName('sales/order')),
            'o.customer_id = e.entity_id',
            array(
                'o.created_at' => 'MAX(o.created_at)',
            )
        );
        $this->groupByAttribute('entity_id')
            ->getSelect()
            ->where('o.created_at IS NULL');
        return $this;
    }

    public function getSelectCountSql() {
        $countSelect = parent::getSelectCountSql();
        $countSelect->reset(Zend_Db_Select::GROUP);
        return $countSelect;
    }

}