<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/28
 * Time: 14:53
 */

namespace app\common\component;


use think\facade\Env;

class Img
{
    const LOCAL = 0;
    const QINIU = 1;
    const UPYUN = 2;

    /**
     * @param string $path
     * @param int $host
     * @param int $width
     * @param int $height
     * @return string
     */
    public static function src($path = '', $host = Img::QINIU, $width = 0, $height = 0)
    {
        if(strpos($path,'http://') !== false || strpos($path, 'https://') !== false){
            if(strpos($path,'qiniudn.com') !== false and strpos($path,'lysoo') !== false){
                // 转换已出错的七牛域名
                $arr = explode('qiniudn.com', $path);
                $path = rtrim(Env::get('qiniu.domain'),'/').$arr[1];
            }
            return $path;

        }elseif($host == Img::QINIU){
            return Img::qiniuSrc($path, $width, $height);
        }

        return $path;

    }

    public static function qiniuSrc($path, $width, $height)
    {
        //七牛无法显示超过10000像素的图片  要做处理
        if($height > 9999)
        {
            $width = intval(($width * 9999)/$height);
            $height = 9999;
        }

        if(strpos($path,'http://') === false && strpos($path,'https://') === false)
            $src = rtrim(Env::get('qiniu.domain'), '/').'/'.ltrim($path, '/');
        else
            $src = $path;

        // 去掉原来的?后面的query信息
        if($width or $height)
        {
            $info = parse_url($src);
            $src = $info['scheme'] . '://' . $info['host'] . $info['path'];
        }

        if($width and $height)
            $src .= '?imageView2/1';
        elseif($width or $height)
            $src .= '?imageView2/2';
        else
            return $src;

        if($width)
            $src .= '/w/'.$width;

        if($height)
            $src .= '/h/'.$height;

        return $src.'/interlace/1/q/100';
    }
}