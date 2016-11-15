<?php  
/**  
  *验证码类  
  */  
session_start();
$test = new Vcode();
//$test->createCode();
$_SESSION['verify_code'] = $test->getCode();
$test->outImg();
  class Vcode{  
    private $width;//图片宽度  
    private $height;//图片高度  
    private $num;//验证码个数  
    private $img;//图片资源  
    private $code;//验证码  
    private $pointNum;//干扰点个数  
    private $lineNum;//干扰线个数  
    private $fontFile;//字体文件  
      
    //构造函数初始化相关数据  
    function __construct($width=85,$height=34,$num=4){  
        $this->width=$width;  
        $this->height=$height;  
        $this->num=$num;  
        $this->code=$this->createCode();  
        $this->pointNum=100;  
        $this->lineNum=10;  
        $this->fontFile="STLITI.TTF";  
    }  
      
    /**  
      *用于设置成员属性  
      *@param string $key 成员属性名  
      *@param mixed $value 成员属性值  
      *@return object 返回自己对象$this,可用于连贯操作  
      */  
    public function set($key,$val){  
        //get_class_vars() 获取类中的属性组成的数组  
        //get_class() 返回对象的类名  
        if(array_key_exists($key,get_class_vars(get_class($this)))){  
            $this->setOption($key,$val);  
        }  
        return $this;  
    }  
    //设置参数  
    private function setOption($key,$value){  
        $this->$key=$value;  
    }  
      
    //获取验证码  
    public function getCode(){  
        return $this->code;  
    }  
      
    //输出图像  
    public function outImg(){  
        //创建图像  
        $this->createImage();  
        //画验证码  
        $this->drawCode();  
        //画干扰元素  
        $this->drawDisturbColor();  
        //输出图像  
        $this->printImg();  
    }  
      
    //画验证码  
    private function drawCode(){  
        $this->fontFile="./font/".$this->fontFile;  
        for($i=0;$i<$this->num;$i++){  
            //设置随机颜色  
            $randColor=imagecolorallocate($this->img,rand(0,128),rand(0,128),rand(0,128));  
            //字体大小  
            $fontSize=rand(70,80);  
            //字体水平位置  
            $x=($this->width/$this->num)*$i;  
            //水平方向的位置  
            $y=rand($fontSize/4, $fontSize/22);  
            //画字体  
            //imagettftext($this->img,$fontSize,0,$x,$y,$randColor,$this->fontFile,$this->code{$i});  
            imageString($this->img, $fontSize, $x, $y, $this->code{$i}, $randColor);
        }  
    }  
    //画干扰元素  
    private function drawDisturbColor(){  
        //画干扰点  
        for($i=0;$i<$this->pointNum;$i++){  
            //设置随机颜色  
            $randColor=imagecolorallocate($this->img,rand(0,255),rand(0,255),rand(0,255));  
            //画点  
            imagesetpixel($this->img,rand(1,$this->width-2),rand(1,$this->height-2),$randColor);  
        }  
          
        //画干扰线  
        for($i=0;$i<$this->lineNum;$i++){  
            //设置随机颜色  
            $randColor=imagecolorallocate($this->img,rand(0,200),rand(0,200),rand(0,200));  
            //画线  
            imageline($this->img,rand(1,$this->width-2),rand(1,$this->height-2),rand(1,$this->height-2),rand(1,$this->width-2),$randColor);  
        }  
    }  
      
    //创建图像  
    private function createImage(){  
        //创建一个真彩色图像  
        $this->img=imagecreatetruecolor($this->width,$this->height);  
        //设置背景色  
        $bgColor=imagecolorallocate($this->img,rand(200,255),rand(200,255),rand(200,255));  
        //填充背景色  
        imagefill($this->img,0,0,$bgColor);  
        //设置边框颜色  
        $borderColor=imagecolorallocate($this->img,0,0,0);  
        //画一个边框  
        imagerectangle($this->img,0,0,$this->width-1,$this->height-1,$borderColor);  
    }  
      
    //输出图像  
    private function printImg(){  
        if(imagetypes() & IMG_PNG){  
            //针对png  
            header("Content-Type:image/png");  
            imagepng($this->img);  
        }else if(imagetypes() & IMG_JPG){  
            //针对jpg  
            header("Content-Type:image/jpeg");  
            imagejpeg($this->img,null,100);  
        }else if(imagetypes() & IMG_GIF){  
            //针对Gif  
            header("Content-Type:image/gif");  
            imagegif($this->img);  
        }else if(imagetypes() & IMG_WBMP){  
            // 针对 WBMP  
            header('Content-Type: image/vnd.wap.wbmp');  
            imagewbmp($this->img);  
        }else{  
            die('No image support in this PHP server');  
        }  
    }  
      
    //创建验证码  
    private function createCode(){  
        //默认字符串  
        $codes="123456789abcdefghijkmnpqrstuvwxyABCDEFGHIJKLMNOPQRSTUVWXY";  
        //生成验证码  
        $code="";  
        for($i=0;$i<$this->num;$i++){  
            $code.=$codes{rand(0,strlen($codes)-1)};  
        }  
        return $code;  
    }  
      
    //析构函数用于销毁图像资源  
    function __destruct(){  
        imagedestroy($this->img);  
    }  
  } 
  
?> 
