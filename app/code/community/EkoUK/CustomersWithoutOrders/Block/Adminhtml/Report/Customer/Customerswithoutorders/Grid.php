<?php

class EkoUK_CustomersWithoutOrders_Block_Adminhtml_Report_Customer_Customerswithoutorders_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    protected $_resourceCollectionName      = 'customerswithoutorders/customerswithoutorders_collection';

    public function getResourceCollectionName()
    {
        return $this->_resourceCollectionName;
    }

    public function getResourceCollection()
    {
        $resourceCollection = Mage::getResourceModel($this->getResourceCollectionName());
        return $resourceCollection;
    }


    public function __construct()
    {
        parent::__construct();
        $this->setId('gridCustomers');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        return $this;
    }

    protected function _prepareCollection()
    {

        $collection = $this->getResourceCollection();
        $this->setCollection($collection);
		 try {
			parent::_prepareCollection();
        }
		 catch (Exception $e) {
            //abort rendering grid and replace collection with an empty one
            $this->setCollection(new Varien_Data_Collection());
        }
        return $this;
	}
    protected function _prepareColumns()
	{
		$this->addColumn('entity_id', array(
			'header'    => Mage::helper('customer')->__('ID'),
			'width'     => '50px',
			'index'     => 'entity_id',
			'type'  => 'number',
		));
		$this->addColumn('name', array(
			'header'    => Mage::helper('customer')->__('Name'),
			'index'     => 'name'
		));
		$this->addColumn('email', array(
			'header'    => Mage::helper('customer')->__('Email'),
			'width'     => '150',
			'index'     => 'email'
		));

		$this->addColumn('Telephone', array(
			'header'    => Mage::helper('customer')->__('Telephone'),
			'width'     => '100',
			'index'     => 'billing_telephone'
		));
		$this->addColumn('billing_country_id', array(
			'header'    => Mage::helper('customer')->__('Country'),
			'width'     => '100',
			'type'      => 'country',
			'index'     => 'billing_country_id',
		));
		$this->addColumn('customer_since', array(
			'header'    => Mage::helper('customer')->__('Customer Since'),
			'type'      => 'datetime',
			'align'     => 'center',
			'index'     => 'created_at',
			
			'gmtoffset' => true
		));
		if (!Mage::app()->isSingleStoreMode()) {
			$this->addColumn('website_id', array(
				'header'    => Mage::helper('customer')->__('Website'),
				'align'     => 'center',
				'width'     => '80px',
				'type'      => 'options',
				'options'   => Mage::getSingleton('adminhtml/system_store')->getWebsiteOptionHash(true),
				'index'     => 'website_id',
			));
		}
		$this->addColumn('action',
			array(
				'header'    =>  Mage::helper('customer')->__('Action'),
				'width'     => '100',
				'type'      => 'action',
				'getter'    => 'getId',
				'actions'   => array(
					 array(
                        'caption'   => Mage::helper('customer')->__('Edit'),
                        'url'       => array('base'=> '*/customer/edit'),
                        'field'     => 'id'
                    )
				),
				'filter'    => false,
				'sortable'  => false,
				'index'     => 'stores',
				'is_system' => true,
		));
		$this->addExportType('*/*/exportCsv', Mage::helper('customerswithoutorders')->__('CSV'));
		$this->addExportType('*/*/exportExcel', Mage::helper('customerswithoutorders')->__('Excel XML'));
		return parent::_prepareColumns();
	}
    public function getRowUrl($row)
    {
        return $this->getUrl('adminhtml/customer/edit', array('id'=>$row->getId()));
    }
}