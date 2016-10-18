<?php
namespace Service;

/**
 * For common services.
 *
 * @package Service
 * @author jsingh7
 * @version 1.0
 */
class Common
{
    public function __construct()
    {

    }

    /**
     * move all the files from one directory to other directories.
     * @param source and destination path
     * @author hkaur5.
     */
    public static function recurse_copy($src, $dst)
    {
        $dir = opendir($src);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    self::recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
    /**
     * function used to calculate number of files present with in the directory.
     * @param directory path
     * @return total number of files with in the directory.
     * @since 07, Nov 2013
     * @author Sunny Patial.
     */
    public static function countDirectoryFiles($dir)
    {
        $i = 0;
        if ($handle = opendir($dir)) {
            while (($file = readdir($handle)) !== false) {
                if (!in_array($file, array('.', '..')) && !is_dir($dir . $file))
                    $i++;
            }
        }
        // prints out how many were in the directory
        return $i;
    }
    /**
     * function used for remove define path directory with all inner files and directories.
     * @param directory path
     * @since 07, Nov 2013
     * @author Sunny Patial.
     */
    public static function deleteDir($dir)
    {
        // open the directory

        if (is_dir($dir)) {
            $dhandle = opendir($dir);

            if ($dhandle) {
                // loop through it
                while (false !== ($fname = readdir($dhandle))) {
                    // if the element is a directory, and
                    // does not start with a '.' or '..'
                    // we call deleteDir function recursively
                    // passing this element as a parameter
                    if (is_dir("{$dir}/{$fname}")) {
                        if (($fname != '.') && ($fname != '..')) {
                            //echo "<u>Deleting Files in the Directory</u>: {$dir}/{$fname} <br />";
                            self::deleteDir("$dir/$fname");
                        }
                        // the element is a file, so we delete it
                    } else {
                        // echo "Deleting File: {$dir}/{$fname} <br />";
                        unlink("{$dir}/{$fname}");
                    }
                }
                closedir($dhandle);
            }
            // now directory is empty, so we can use
            // the rmdir() function to delete it
            //	echo "<u>Deleting Directory</u>: {$dir} <br />";
            rmdir($dir);
        }
    }
    /**
     * function used for generating random string
     * containing atleast one special character and one number.
     *
     * @param integer length [ min length should be 8 ]
     * @return string
     * @author Jsingh7
     */
    public static function generatePassword($len = 8)
    {
        $alpha_string_length = $len - 2;
        $numbers = "0123456789";
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $spl_chars = "!@#$%^&*";
        $alphas ="";

        for ($p = 0; $p < $alpha_string_length; $p++) {
            $alphas .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        $nums = $numbers[mt_rand(0, strlen($numbers) - 1)];
        $spls = $spl_chars[mt_rand(0, strlen($spl_chars) - 1)];

        $temp_arr = array($alphas, $nums, $spls);
        shuffle($temp_arr);
        return implode('', $temp_arr);
    }
    /**
     * Returns broken string with symbol (...),
     * if length exceeds.
     *
     * @param string $str
     * @param integer $len
     * @param boolean $tail [optional]
     * @param string $tail_str [optional](by default it is "...")
     * @author jsingh7
     * @version 1.0
     */
    public static function showCroppedText($str, $len, $tail = true, $tail_str = "...")
    {
        if ($tail):
            $dot_dot_dot = $tail_str;
        else:
            $dot_dot_dot = "";
        endif;
        if (strlen(trim($str)) > $len + 1):return utf8_decode(substr($str, 0, $len)) . $dot_dot_dot;
        else:return utf8_decode($str);
        endif;
    }
    /**
     * Returns unique file name.
     *
     * @param str $file_name
     * @param str $unique_identifier[optional](will append with file name to make it unique).
     * @author jsingh7
     * @version 1.1
     * @date 1 july 2016
     */
    static public function getUniqueNameForFile($file_name, $unique_identifier=null)
    {
        if ($file_name) {
            $temp_img_name = preg_replace('/\s./', '_', $file_name);
            $chunks = explode(".", $temp_img_name);
            $concat_img_name = "";
            $numItems = count($chunks);
            $i = 0;
            $ext = "";
            foreach ($chunks as $key => $value) {
                if (++$i === $numItems)// last element(http://stackoverflow.com/questions/665135/find-the-last-element-of-an-array-while-using-a-foreach-loop-in-php)
                {
                    $ext = "." . $value;
                } else {
                    $concat_img_name .= $value . "_";
                }
            }
            if(!$unique_identifier)
            {
                $unique_identifier = strtotime(date("Y-m-d H:i:s"));
            }
            return self::showCroppedText($concat_img_name, 30, false) . "_" . $unique_identifier . $ext;
        } else {
            throw new Exception("File name not provided in getUniqueNameForFile function!");
        }
    }
    /**
     *
     * @param unknown_type $dir
     * @return multitype:NULL unknown
     */
    public static function dirToArray($dir)
    {

        $result = array();

        $cdir = scandir($dir);
        foreach ($cdir as $key => $value) {
            if (!in_array($value, array(".", ".."))) {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                    $result[$value] = self::dirToArray($dir . DIRECTORY_SEPARATOR . $value);

                } else {
                    $result[] = $value;
                }
            }
        }
        return $result;
    }
    /**
     * Logs message.
     *
     * @param string $msg
     * @param integer $msg_color [optional] [color of msg will be according to the color passed.]
     * @param string $filename [optional]
     * @author hkaur5
     * @author jsingh7 [Added timestamp inside this function.]
     * @version 1.1
     */
    public static function logInfo($msg, $msg_color='#000000', $filename = 'logs/app_log.html')
    {
        $log_msg = "<span style='color:".$msg_color."; display:block;'>".date('d-M-Y H:i:s l T').": ".$msg."</span>";
        file_put_contents($filename, $log_msg.PHP_EOL , FILE_APPEND);
    }
}