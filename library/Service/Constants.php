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
    public function error($status)
    {
        if ($status == '1')
        {
            return $this->no_Record_found = "<h5><b>No Record Found.</b></h5>";
        }
        else
        {
            return $this->no_Record_found = "<h5><b>Invalid First name.</b></h5>";
        }
    }
}