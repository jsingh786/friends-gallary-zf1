<?php
class fileController extends Zend_Controller_Action
 {
  	public function fileAction
  	{
    $adapter = new Zend_File_Transfer_Adapter_Http();
    $adapter->setDestination('C:\temp');
    if (!$adapter->receive()) 
    {
        $messages = $adapter->getMessages();
        echo implode("\n", $messages);
    }
}