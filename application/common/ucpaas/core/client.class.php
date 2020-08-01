<?php
	class client{
		var $SoftVersion; 
		var $AccountSid ;
		var $functionstr;
		var $operation;
		var $sig;
		var $time;
		var $token;
		
		function __construct(){
			$this->SoftVersion=$GLOBALS['SoftVersion'];
			$this->AccountSid=$GLOBALS['sid'];
			$this->token=$GLOBALS['token'];
			$timestamp = round(1000*microtime(true));
			if($timestamp < 100 && $timestamp > 9) $timestamp = '0'.$timestamp;
			elseif ($timestamp < 10) $timestamp = '00'.$timestamp;
			$this->time = date('YmdHis');//.$timestamp;  
			$this->sig= strtoupper(md5($this->AccountSid.$this->token.$this->time));
			
			$this->Authorization=base64_encode($this->AccountSid.':'.$this->time); 
			
		}
		function post($data)
		{ 
		   $header = array(
				'Accept:application/json;',
				'Content-Type:application/json;charset=utf-8;',
				'Authorization:'.$this->Authorization
			);
			
			
			$url='https://api.ucpaas.com/'.$this->SoftVersion.'/Accounts/'.$this->AccountSid.'/'.$this->functionstr.'/'.$this->operation.'?sig='.$this->sig;
			
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
			$output = curl_exec($ch);
			   
			$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($status != 200){
				$output =  array(
					'status' => $status,
					'errno' => curl_errno($ch),
					'error' => curl_error($ch)
				);
			}else{
				$output = json_decode($output,true);
			} 
			curl_close($ch);
			return $output;
		}
	}
?>