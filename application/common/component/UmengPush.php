<?php
namespace app\common\component;

require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidBroadcast.php');
require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidFilecast.php');
require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidGroupcast.php');
require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidUnicast.php');
require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidCustomizedcast.php');
require_once(dirname(__FILE__) . '/' . 'notification/ios/IOSBroadcast.php');
require_once(dirname(__FILE__) . '/' . 'notification/ios/IOSFilecast.php');
require_once(dirname(__FILE__) . '/' . 'notification/ios/IOSGroupcast.php');
require_once(dirname(__FILE__) . '/' . 'notification/ios/IOSUnicast.php');
require_once(dirname(__FILE__) . '/' . 'notification/ios/IOSCustomizedcast.php');

class UmengPush {
	protected $appkey           = NULL; 
	protected $appMasterSecret  = NULL;
	protected $timestamp        = NULL;
	protected $validation_token = NULL;

	function __construct($key, $secret) {
		$this->appkey = $key;
		$this->appMasterSecret = $secret;
		$this->timestamp = strval(time());
	}

	function sendAndroidBroadcast($text,$params,$title = '') {
		try {
			$brocast = new \AndroidBroadcast();
			$brocast->setAppMasterSecret($this->appMasterSecret);
			$brocast->setPredefinedKeyValue("appkey",           $this->appkey);
			$brocast->setPredefinedKeyValue("timestamp",        $this->timestamp);
			$brocast->setPredefinedKeyValue("ticker",           $text);
			$brocast->setPredefinedKeyValue("title",            $title ? $title : $text);
			$brocast->setPredefinedKeyValue("text",             $text);
            $brocast->setPredefinedKeyValue("after_open",       "go_custom");
            $brocast->setPredefinedKeyValue("custom",           "go_custom");
			// Set 'production_mode' to 'false' if it's a test device.
			// For how to register a test device, please see the developer doc.
			$brocast->setPredefinedKeyValue("production_mode", "true");
			// [optional]Set extra fields

            foreach($params as $k=>$v){
                $brocast->setExtraField($k, $v);
            }

			return $brocast->send();
		} catch (\Exception $e) {
			return ("Caught exception: " . $e->getMessage());
		}
	}

	function sendAndroidUnicast() {
		try {
			$unicast = new \AndroidUnicast();
			$unicast->setAppMasterSecret($this->appMasterSecret);
			$unicast->setPredefinedKeyValue("appkey",           $this->appkey);
			$unicast->setPredefinedKeyValue("timestamp",        $this->timestamp);
			// Set your device tokens here
			$unicast->setPredefinedKeyValue("device_tokens",    "xx"); 
			$unicast->setPredefinedKeyValue("ticker",           "Android unicast ticker");
			$unicast->setPredefinedKeyValue("title",            "Android unicast title");
			$unicast->setPredefinedKeyValue("text",             "Android unicast text");
			$unicast->setPredefinedKeyValue("after_open",       "go_app");
			// Set 'production_mode' to 'false' if it's a test device. 
			// For how to register a test device, please see the developer doc.
			$unicast->setPredefinedKeyValue("production_mode", "true");
			// Set extra fields
			$unicast->setExtraField("test", "helloworld");
			print("Sending unicast notification, please wait...\r\n");
			$unicast->send();
			print("Sent SUCCESS\r\n");
		} catch (\Exception $e) {
			print("Caught exception: " . $e->getMessage());
		}
	}

	function sendAndroidFilecast() {
		try {
			$filecast = new \AndroidFilecast();
			$filecast->setAppMasterSecret($this->appMasterSecret);
			$filecast->setPredefinedKeyValue("appkey",           $this->appkey);
			$filecast->setPredefinedKeyValue("timestamp",        $this->timestamp);
			$filecast->setPredefinedKeyValue("ticker",           "Android filecast ticker");
			$filecast->setPredefinedKeyValue("title",            "Android filecast title");
			$filecast->setPredefinedKeyValue("text",             "Android filecast text");
			$filecast->setPredefinedKeyValue("after_open",       "go_app");  //go to app
			print("Uploading file contents, please wait...\r\n");
			// Upload your device tokens, and use '\n' to split them if there are multiple tokens
			$filecast->uploadContents("aa"."\n"."bb");
			print("Sending filecast notification, please wait...\r\n");
			$filecast->send();
			print("Sent SUCCESS\r\n");
		} catch (\Exception $e) {
			print("Caught exception: " . $e->getMessage());
		}
	}

	function sendAndroidGroupcast() {
		try {
			/* 
		 	 *  Construct the filter condition:
		 	 *  "where": 
		 	 *	{
    	 	 *		"and": 
    	 	 *		[
      	 	 *			{"tag":"test"},
      	 	 *			{"tag":"Test"}
    	 	 *		]
		 	 *	}
		 	 */
			$filter = 	array(
							"where" => 	array(
								    		"and" 	=>  array(
								    						array(
							     								"tag" => "test"
															),
								     						array(
							     								"tag" => "Test"
								     						)
								     		 			)
								   		)
					  	);
					  
			$groupcast = new \AndroidGroupcast();
			$groupcast->setAppMasterSecret($this->appMasterSecret);
			$groupcast->setPredefinedKeyValue("appkey",           $this->appkey);
			$groupcast->setPredefinedKeyValue("timestamp",        $this->timestamp);
			// Set the filter condition
			$groupcast->setPredefinedKeyValue("filter",           $filter);
			$groupcast->setPredefinedKeyValue("ticker",           "Android groupcast ticker");
			$groupcast->setPredefinedKeyValue("title",            "Android groupcast title");
			$groupcast->setPredefinedKeyValue("text",             "Android groupcast text");
			$groupcast->setPredefinedKeyValue("after_open",       "go_app");
			// Set 'production_mode' to 'false' if it's a test device. 
			// For how to register a test device, please see the developer doc.
			$groupcast->setPredefinedKeyValue("production_mode", "true");
			print("Sending groupcast notification, please wait...\r\n");
			$groupcast->send();
			print("Sent SUCCESS\r\n");
		} catch (\Exception $e) {
			print("Caught exception: " . $e->getMessage());
		}
	}

	function sendAndroidCustomizedcast($group_id, $ticker, $text, $params) {
		try {
			$customizedcast = new \AndroidCustomizedcast();
			$customizedcast->setAppMasterSecret($this->appMasterSecret);
			$customizedcast->setPredefinedKeyValue("appkey",           $this->appkey);
			$customizedcast->setPredefinedKeyValue("timestamp",        $this->timestamp);
			// Set your alias here, and use comma to split them if there are multiple alias.
			// And if you have many alias, you can also upload a file containing these alias, then 
			// use file_id to send customized notification.
			$customizedcast->setPredefinedKeyValue("alias",            $group_id);
			// Set your alias_type here
//			$customizedcast->setPredefinedKeyValue("alias_type",       'kUMessageAliasTypeUserId');
			$customizedcast->setPredefinedKeyValue("alias_type",       'groupid');
			$customizedcast->setPredefinedKeyValue("ticker",           $ticker);
			$customizedcast->setPredefinedKeyValue("title",            $ticker);
			$customizedcast->setPredefinedKeyValue("text",             $text);
			$customizedcast->setPredefinedKeyValue("after_open",       "go_app");

            foreach($params as $k=>$v){
                $customizedcast->setExtraField($k, $v);
            }

            return $customizedcast->send();
		} catch (\Exception $e) {
			return "Caught exception: " . $e->getMessage();
		}
	}

    // 自定义文件播
    function sendAndroidCustomizedFilecast($title, $text, $params, $groupid) {
        try {

			if(!cache('android_'.$groupid)) {
                // 上传获取file_id
                $filecast = new \AndroidFilecast();
				$filecast->setAppMasterSecret($this->appMasterSecret);
				$filecast->setPredefinedKeyValue("appkey",           $this->appkey);
				$filecast->setPredefinedKeyValue("timestamp",        $this->timestamp);
				$filecast->setPredefinedKeyValue("production_mode",  "true");
//                $filecast->setPredefinedKeyValue("ticker",           "ticker");
//                $filecast->setPredefinedKeyValue("title",            "title");
//                $filecast->setPredefinedKeyValue("text",             "text");
				$filecast->uploadContents("$groupid");
				$file_id = $filecast->getFileId();
                cache('android_'.$groupid, $file_id);
            } else{
                $file_id = cache('android_'.$groupid);
            }

			$customizedcast = new \AndroidCustomizedcast();
            $customizedcast->setAppMasterSecret($this->appMasterSecret);
            $customizedcast->setPredefinedKeyValue("appkey",           $this->appkey);
            $customizedcast->setPredefinedKeyValue("timestamp",        $this->timestamp);
            $customizedcast->setPredefinedKeyValue("file_id",          $file_id);
            // Set your alias_type here
            $customizedcast->setPredefinedKeyValue("alias_type",       'groupid');
            $customizedcast->setPredefinedKeyValue("ticker",           $title);
            $customizedcast->setPredefinedKeyValue("title",            $title);
            $customizedcast->setPredefinedKeyValue("text",             $text);
            $customizedcast->setPredefinedKeyValue("after_open",       "go_custom");
            $customizedcast->setPredefinedKeyValue("custom",           "custom_field");
            $customizedcast->setPredefinedKeyValue("production_mode",  "true");
            foreach($params as $k=>$v){
                $customizedcast->setExtraField($k, $v);
            }

            return $customizedcast->send();
        } catch (\Exception $e) {
            return "Caught exception: " . $e->getMessage();
        }
    }

	function sendIOSBroadcast($text, $params) {
		try {
			$brocast = new \IOSBroadcast();
			$brocast->setAppMasterSecret($this->appMasterSecret);
			$brocast->setPredefinedKeyValue("appkey",           $this->appkey);
			$brocast->setPredefinedKeyValue("timestamp",        $this->timestamp);

            $brocast->setPredefinedKeyValue("alert", $text);
			$brocast->setPredefinedKeyValue("badge", 1);
            $brocast->setPredefinedKeyValue("sound", "chime");

			// Set 'production_mode' to 'true' if your app is under production mode
			$brocast->setPredefinedKeyValue("production_mode", "true");
			// Set customized fields
			foreach($params as $k=>$v){
                $brocast->setCustomizedField($k, $v);
            }

			return $brocast->send();
		} catch (\Exception $e) {
			return ("Caught exception: " . $e->getMessage());
		}
	}

	function sendIOSUnicast() {
		try {
			$unicast = new \IOSUnicast();
			$unicast->setAppMasterSecret($this->appMasterSecret);
			$unicast->setPredefinedKeyValue("appkey",           $this->appkey);
			$unicast->setPredefinedKeyValue("timestamp",        $this->timestamp);
			// Set your device tokens here
			$unicast->setPredefinedKeyValue("device_tokens",
                "d95e6e8101fe9a84e483c06013b047099f2437bdf05fdb970d56cdea9486cea6"
            );
			$unicast->setPredefinedKeyValue("alert", "IOS 单播测试");
			$unicast->setPredefinedKeyValue("badge", 0);
			$unicast->setPredefinedKeyValue("sound", "chime");
			// Set 'production_mode' to 'true' if your app is under production mode
			$unicast->setPredefinedKeyValue("production_mode", "false");
			// Set customized fields
			$unicast->setCustomizedField("test", "helloworld");
			print("Sending unicast notification, please wait...\r\n");
			$unicast->send();
			print("Sent SUCCESS\r\n");
		} catch (\Exception $e) {
			print("Caught exception: " . $e->getMessage());
		}
	}

	function sendIOSFilecast() {
		try {
			$filecast = new \IOSFilecast();
			$filecast->setAppMasterSecret($this->appMasterSecret);
			$filecast->setPredefinedKeyValue("appkey",           $this->appkey);
			$filecast->setPredefinedKeyValue("timestamp",        $this->timestamp);

			$filecast->setPredefinedKeyValue("alert", "IOS 文件播测试");
			$filecast->setPredefinedKeyValue("badge", 0);
			$filecast->setPredefinedKeyValue("sound", "chime");
			// Set 'production_mode' to 'true' if your app is under production mode
			$filecast->setPredefinedKeyValue("production_mode", "false");
			print("Uploading file contents, please wait...\r\n");
			// Upload your device tokens, and use '\n' to split them if there are multiple tokens
			$filecast->uploadContents("aa"."\n"."bb");
			print("Sending filecast notification, please wait...\r\n");
			$filecast->send();
			print("Sent SUCCESS\r\n");
		} catch (\Exception $e) {
			print("Caught exception: " . $e->getMessage());
		}
	}

	function sendIOSGroupcast() {
		try {
			/* 
		 	 *  Construct the filter condition:
		 	 *  "where": 
		 	 *	{
    	 	 *		"and": 
    	 	 *		[
      	 	 *			{"tag":"iostest"}
    	 	 *		]
		 	 *	}
		 	 */
			$filter = 	array(
							"where" => 	array(
								    		"and" 	=>  array(
								    						array(
							     								"tag" => "iostest"
															)
								     		 			)
								   		)
					  	);
					  
			$groupcast = new \IOSGroupcast();
			$groupcast->setAppMasterSecret($this->appMasterSecret);
			$groupcast->setPredefinedKeyValue("appkey",           $this->appkey);
			$groupcast->setPredefinedKeyValue("timestamp",        $this->timestamp);
			// Set the filter condition
			$groupcast->setPredefinedKeyValue("filter",           $filter);
			$groupcast->setPredefinedKeyValue("alert", "IOS 组播测试");
			$groupcast->setPredefinedKeyValue("badge", 0);
			$groupcast->setPredefinedKeyValue("sound", "chime");
			// Set 'production_mode' to 'true' if your app is under production mode
			$groupcast->setPredefinedKeyValue("production_mode", "false");
			print("Sending groupcast notification, please wait...\r\n");
			$groupcast->send();
			print("Sent SUCCESS\r\n");
		} catch (\Exception $e) {
			print("Caught exception: " . $e->getMessage());
		}
	}

	function sendIOSCustomizedcast($group_id, $alert, $params) {
		try {
			$customizedcast = new \IOSCustomizedcast();
			$customizedcast->setAppMasterSecret($this->appMasterSecret);
			$customizedcast->setPredefinedKeyValue("appkey",           $this->appkey);
			$customizedcast->setPredefinedKeyValue("timestamp",        $this->timestamp);

			// Set your alias here, and use comma to split them if there are multiple alias.
			// And if you have many alias, you can also upload a file containing these alias, then 
			// use file_id to send customized notification.
			$customizedcast->setPredefinedKeyValue("alias", $group_id);
			// Set your alias_type here
			$customizedcast->setPredefinedKeyValue("alias_type", 'groupid');
			$customizedcast->setPredefinedKeyValue("alert", $alert);
//			$customizedcast->setPredefinedKeyValue("badge", 0);
			$customizedcast->setPredefinedKeyValue("sound", "chime");
			// Set 'production_mode' to 'true' if your app is under production mode
			$customizedcast->setPredefinedKeyValue("production_mode", "false");

            foreach($params as $k=>$v){
                $customizedcast->setCustomizedField($k, $v);
            }

            return $customizedcast->send();
		} catch (\Exception $e) {
			return "Caught exception: " . $e->getMessage();
		}
	}

    // 自定义文件播
    function sendIOSCustomizedFilecast($title, $params, $groupid) {
        try {
            cache('ios_'.$groupid,null);
            if(!cache('ios_'.$groupid)) {
                // 上传获取file_id
                $filecast = new \IOSFilecast();
                $filecast->setAppMasterSecret($this->appMasterSecret);
                $filecast->setPredefinedKeyValue("appkey",           $this->appkey);
                $filecast->setPredefinedKeyValue("timestamp",        $this->timestamp);
                $filecast->setPredefinedKeyValue("production_mode",   "true");
//                $filecast->setPredefinedKeyValue("alert", "IOS 文件播测试");
                $filecast->uploadContents("$groupid");
                $file_id = $filecast->getFileId();
                cache('ios_'.$groupid, $file_id);
            }
            else{
                $file_id = cache('ios_'.$groupid);
            }

            $customizedcast = new \IOSCustomizedcast();
            $customizedcast->setAppMasterSecret($this->appMasterSecret);
            $customizedcast->setPredefinedKeyValue("appkey",           $this->appkey);
            $customizedcast->setPredefinedKeyValue("timestamp",        $this->timestamp);

            // Set your alias here, and use comma to split them if there are multiple alias.
            // And if you have many alias, you can also upload a file containing these alias, then
            // use file_id to send customized notification.
            $customizedcast->setPredefinedKeyValue("file_id",          $file_id);
            // Set your alias_type here
            $customizedcast->setPredefinedKeyValue("alias_type", 'groupid');
            $customizedcast->setPredefinedKeyValue("alert", $title);
//			$customizedcast->setPredefinedKeyValue("badge", 0);
            $customizedcast->setPredefinedKeyValue("sound", "chime");
            // Set 'production_mode' to 'true' if your app is under production mode
            $customizedcast->setPredefinedKeyValue("production_mode", "true");

            foreach($params as $k=>$v){
                $customizedcast->setCustomizedField($k, $v);
            }

            return $customizedcast->send();
        } catch (\Exception $e) {
            return "Caught exception: " . $e->getMessage();
        }
    }
}