<?php
namespace Service;

/**
 * Class Constants holds all the
 * useful constants.
 * @package Service
 */
class Constants
{
    public $no_Record_found;
    public $valid_name;
    public function error($status)
    {
        if ($status == '1')
        {
            return $this->no_Record_found = "<h5><b>No Record Found.</b></h5>";
        }
        else
        {
            return $this->no_Record_found = "<h5><b>Enter Name Only.</b></h5>";
        }
    }
}