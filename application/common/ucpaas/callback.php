<?php
/**
	 * 返回xml数据(DOM方式)
	 */
	  function return_back_xmlDOM($retcode,$reason){
		$doc = new DOMDocument('1.0', 'utf-8');
		$response = $doc->createElement('response');
		$retcode = $doc->createElement('retcode',$retcode);
		$reason = $doc->createElement('reason',$reason);
		$response->appendChild($retcode);
		$response->appendChild($reason);
		$doc->appendChild($response);
		$data = $doc->saveXML();
		return $data;
	}

	/**
	 * 返回xml数据
	 */
	 function return_back_xml($retcode,$reason){
		$data = '<?xml version="1.0" encoding="utf-8"?>';
		$data .= '<response>';
		//$data .= '<response>';
		$data .= '<retcode>'.$retcode.'</retcode>';
		$data .= '<reason>'.$reason.'</reason>';
		$data .= '</response>';
		return $data;
	}
	$xmldata = file_get_contents("php://input");
	$data=json_decode($xmldata,true); 
	file_put_contents('log.txt',var_export($data,true)." ext\r\n",FILE_APPEND );
	//挂断时，解除绑定
	
	echo return_back_xml('0','无');
?>