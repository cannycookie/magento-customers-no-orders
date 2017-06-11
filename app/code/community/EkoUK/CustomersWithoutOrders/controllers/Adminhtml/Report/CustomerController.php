<?php
class EkoUK_CustomersWithoutOrders_Adminhtml_Report_CustomerController extends Mage_Adminhtml_Controller_Action
{


    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('report/customers/customerswithoutorders');
    }

    public function _initAction()
    {

        $this->loadLayout()
            ->_addBreadcrumb(Mage::helper('reports')->__('Reports'), Mage::helper('reports')->__('Reports'))
            ->_addBreadcrumb(Mage::helper('reports')->__('Customers'), Mage::helper('reports')->__('Customers'))
            ->_addBreadcrumb(Mage::helper('reports')->__('Customers without orders'), Mage::helper('reports')->__('Customers without orders'));

        return $this;
    }
	
	public function customerswithoutordersAction()
    {
    $this->_initAction()
        ->_setActiveMenu('report/customer/customerswithoutorders')
        ->_addBreadcrumb(Mage::helper('reports')->__('Customers without Orders'), Mage::helper('reports')->__('Customers without Orders'))
        ->_addContent($this->getLayout()->createBlock('customerswithoutorders/adminhtml_report_customer_customerswithoutorders'));
        $this->renderLayout();
    }

	/**
    * Export Customer grid to CSV format
    */
    public function exportCsvAction()
    {
       $fileName   = 'customers-no-orders.csv';
       $csv       =  $this->getLayout()->createBlock('customerswithoutorders/adminhtml_report_customer_customerswithoutorders_grid')->getCsvFile();
       $this->_prepareDownloadResponse($fileName, $csv);
    }
	/**
    * Export Customer grid to Excel format
    */
	public function exportExcelAction()  
	{  
	
		$fileName   = 'customers-no-orders.xls';
		$xls    = $this->getLayout()->createBlock('customerswithoutorders/adminhtml_report_customer_customerswithoutorders_grid')->getExcelFile();
		$this->_prepareDownloadResponse($fileName, $xls);  
	}  
	
}