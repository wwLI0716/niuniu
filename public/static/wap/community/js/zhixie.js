/*eslint-disable */
const CONTAINER_AGENT_ANDROID_APP = 1;
const CONTAINER_AGENT_ANDROID_BROSWER = 2;
const CONTAINER_AGENT_IOS = 3;
const CONTAINER_AGENT_WEIXIN = 4;

var ZhixieJsBridge = (function() {
	// alert('in');
	var ZhixieJsBridgeObj = {};
	// 判断当前页面所属的平台
	var browser = {
		versions: function() {
			var u = navigator.userAgent,
				app = navigator.appVersion;
			return {
				trident: u.indexOf('Trident') > -1, //IE内核
				presto: u.indexOf('Presto') > -1, //opera内核
				webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
				gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
				mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
				ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
				android: u.indexOf('Android') > -1 || u.indexOf('Adr') > -1, //android终端
				iPhone: u.indexOf('iPhone') > -1, //是否为iPhone或者QQHD浏览器
				iPad: u.indexOf('iPad') > -1, //是否iPad
				webApp: u.indexOf('Safari') == -1, //是否web应该程序，没有头部与底部
				weixin: u.indexOf('MicroMessenger') > -1, //是否微信 （2015-01-22新增）
				qq: u.match(/\sQQ/i) == " qq" //是否为iPhone或者QQHD浏览器
			};
		}(),
		language: (navigator.browserLanguage || navigator.language).toLowerCase()
	}
	if (browser.versions.android) {
		if (browser.versions.weixin) {
			ZhixieJsBridgeObj.SubordinatePlatform = CONTAINER_AGENT_WEIXIN;
		} else {
			ZhixieJsBridgeObj.SubordinatePlatform = CONTAINER_AGENT_ANDROID_APP;
		}
	} else if (browser.versions.ios) {
		if (browser.versions.weixin) {
			ZhixieJsBridgeObj.SubordinatePlatform = CONTAINER_AGENT_WEIXIN;
		} else {
			ZhixieJsBridgeObj.SubordinatePlatform = CONTAINER_AGENT_IOS;
		}
	} else {
		ZhixieJsBridgeObj.SubordinatePlatform = CONTAINER_AGENT_ANDROID_BROSWER;
	}
	// alert(ZhixieJsBridgeObj.SubordinatePlatform);
	return ZhixieJsBridgeObj;
})();

ZhixieJsBridge.callBackFuncList = {}
ZhixieJsBridge.chooseImg = function(paramsObj) {
	var type = paramsObj.type;
	ZhixieJsBridge.callBackFuncList = paramsObj.success;
	switch (ZhixieJsBridge.SubordinatePlatform) {
		case CONTAINER_AGENT_ANDROID_APP:
			console.log(12121212)
			zhixie.photosOralbums('{"type":"' + type + '","resultMethod":"ZhixieJsBridge.callBackFuncList"}');
			break;
		case CONTAINER_AGENT_IOS:
			window.ios_image_picker()
			window.ios_image_picker_cb = (url) => {
				ZhixieJsBridge.callBackFuncList({
					flag: '1',
					type: '1',
					result: url
				})
			}
			break;
			// case CONTAINER_AGENT_ANDROID_BROSWER:
			// 	// alert('web');
			// 	var result = '{"flag":"0","message":"请在安卓平台使用，谢谢！"}';
			// 	ZhixieJsBridge.callBackFuncList(result);
			// 	break;
			// case CONTAINER_AGENT_ANDROID_IOS:
			// 	break;
			// case CONTAINER_AGENT_WEIXIN:
			// 	break;
		default:
			// alert('error');
			var result = '{"flag":"0","message":"请在安卓平台使用，谢谢！"}';
			ZhixieJsBridge.callBackFuncList(result);
	}
}
ZhixieJsBridge.uploadImage = function(paramsObj) {
	var uuid = paramsObj.uuid;
	var url = paramsObj.url;
	// alert(uuid);
	ZhixieJsBridge.callBackFuncList = paramsObj.success;
	switch (ZhixieJsBridge.SubordinatePlatform) {
		case CONTAINER_AGENT_ANDROID_APP:
			zhixie.uploadImageFile('{"uuid":"' + uuid + '","url":"' + url + '","resultMethod":"ZhixieJsBridge.callBackFuncList"}');
			break;
		case CONTAINER_AGENT_IOS:
			console.log('上传开始···············································')
			window.ios_upload(uuid, 'image', url)
			window.ios_upload_cb = (res) => {
				console.log(res, '上传返回')
				if (typeof res === 'string') {
					res = JSON.parse(res)
				}
				if (res.errcode === '0') {
					console.log(res, '上传返回成功')
					ZhixieJsBridge.callBackFuncList(res.data);
				}
			}
			break;
			// case CONTAINER_AGENT_ANDROID_BROSWER:
			// 	// alert('web');
			// 	var result = '{"flag":"0","message":"请在安卓平台使用，谢谢！"}';
			// 	ZhixieJsBridge.callBackFuncList(result);
			// 	break;
			// case CONTAINER_AGENT_ANDROID_IOS:
			// 	break;
			// case CONTAINER_AGENT_WEIXIN:
			// 	break;
		default:
			// alert('error');
			var result = '{"flag":"0","message":"请在安卓平台使用，谢谢！"}';
			ZhixieJsBridge.callBackFuncList(result);
	}
}
ZhixieJsBridge.getGPS = function(paramsObj) {
	ZhixieJsBridge.callBackFuncList = paramsObj.success;
	switch (ZhixieJsBridge.SubordinatePlatform) {
		case CONTAINER_AGENT_ANDROID_APP:
			zhixie.getGPSpoint('{"resultMethod":"ZhixieJsBridge.callBackFuncList"}');
			break;
		case CONTAINER_AGENT_IOS:
			window.ios_location()
			window.ios_location_cb = (lat, lng) => {
				const res = {}
				res.longitude = lng
				res.latitude = lat
				res.flag = '1'
				ZhixieJsBridge.callBackFuncList(res);
			}
			break;
			// case CONTAINER_AGENT_ANDROID_BROSWER:
			// 	// alert('web');
			// 	var result = '{"flag":"0","message":"请在安卓平台使用，谢谢！"}';
			// 	ZhixieJsBridge.callBackFuncList(result);
			// 	break;
			// case CONTAINER_AGENT_ANDROID_IOS:
			// 	break;
			// case CONTAINER_AGENT_WEIXIN:
			// 	break;
		default:
			// alert('error');
			var result = '{"flag":"0","message":"请在安卓平台使用，谢谢！"}';
			ZhixieJsBridge.callBackFuncList(result);
	}
}
ZhixieJsBridge.openNewWebView = function(paramsObj) {
	var type = paramsObj.type;
	var url = paramsObj.url;
	ZhixieJsBridge.callBackFuncList = paramsObj.success;
	switch (ZhixieJsBridge.SubordinatePlatform) {
		case CONTAINER_AGENT_ANDROID_APP:
			zhixie.openNewWebActivity('{"type":"' + type + '", "url":"' + url + '"}');
			break;
			// case CONTAINER_AGENT_ANDROID_BROSWER:
			// 	// alert('web');
			// 	var result = '{"flag":"0","message":"请在安卓平台使用，谢谢！"}';
			// 	ZhixieJsBridge.callBackFuncList(result);
			// 	break;
			// case CONTAINER_AGENT_ANDROID_IOS:
			// 	break;
			// case CONTAINER_AGENT_WEIXIN:
			// 	break;
		default:
			// alert('error');
			var result = '{"flag":"0","message":"请在安卓平台使用，谢谢！"}';
			ZhixieJsBridge.callBackFuncList(result);
	}
}
ZhixieJsBridge.closeWebView = function(paramsObj) {
	ZhixieJsBridge.callBackFuncList = paramsObj.success;
	switch (ZhixieJsBridge.SubordinatePlatform) {
		case CONTAINER_AGENT_ANDROID_APP:
			zhixie.finishActivity();
			break;
			// case CONTAINER_AGENT_ANDROID_BROSWER:
			// 	// alert('web');
			// 	var result = '{"flag":"0","message":"请在安卓平台使用，谢谢！"}';
			// 	ZhixieJsBridge.callBackFuncList(result);
			// 	break;
			// case CONTAINER_AGENT_ANDROID_IOS:
			// 	break;
			// case CONTAINER_AGENT_WEIXIN:
			// 	break;
		default:
			// alert('error');
			var result = '{"flag":"0","message":"请在安卓平台使用，谢谢！"}';
			ZhixieJsBridge.callBackFuncList(result);
	}
}


/*eslint-enable */
