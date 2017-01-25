<?php
/**
 * 
 * @author dhirajwebappclouds
 *
 */
class MY_Log extends CI_Log  {

		
	function __construct()
	{	
		$config =& get_config();
		
		parent::__construct();	
		
				
	}

	public function write_log($level = 'error', $msg, $php_error = false) { //here overriding
		if ($this->_enabled === FALSE)
		{
			return FALSE;
		}

		$level = strtoupper($level);

		if ( ! isset($this->_levels[$level]) OR
				($this->_levels[$level] > $this->_threshold))
		{
			return FALSE;
		}
		
		// if info create custom log
		if($level == 'INFO'){
			
			/* HERE YOUR LOG FILENAME YOU CAN CHANGE ITS NAME */
			$filepath = $this->_log_path.'customlog-'.date('Y-m-d').'.log';
			$message  = '';
			
			if ( ! file_exists($filepath))
			{
				$message .= "Salon Report Custom Log File\n\n";
			}
			
			if ( ! $fp = @fopen($filepath, FOPEN_WRITE_CREATE))
			{
				return FALSE;
			}
						
			$message .= date($this->_date_fmt). ' --> '.$msg."\n";
			
		}else{
			
			/* HERE YOUR LOG FILENAME YOU CAN CHANGE ITS NAME */
			$filepath = $this->_log_path.'log-'.date('Y-m-d').EXT;
			$message  = '';
				
			if ( ! file_exists($filepath))
			{
				$message .= "<"."?php  if ( ! defined('BASEPATH'))
        exit('No direct script access allowed'); ?".">\n\n";
			}
				
			if ( ! $fp = @fopen($filepath, FOPEN_WRITE_CREATE))
			{
				return FALSE;
			}
			
			$message .= date($this->_date_fmt). ' --> '.$msg."\n";
		}
		
		flock($fp, LOCK_EX);
		fwrite($fp, $message);
		flock($fp, LOCK_UN);
		fclose($fp);

		@chmod($filepath, FILE_WRITE_MODE);
		return TRUE;
	}
}