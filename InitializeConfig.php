<?php
/**
 * Created by PhpStorm.
 * User: pizepei
 * Date: 2019/2/1
 * Time: 16:19
 * @title 初始化配置
 */
declare(strict_types=1);
namespace normphp\config;


use config\app\SetConfig;
use normphp\helper\Helper;
use normphp\staging\App;

class InitializeConfig
{

    /**
     * 需要的配置名称(类名称)
     */
    const configName = [
        'Config',
        #'Service',
        #'WechatConfig',
        'RedsiConfig',
    ];
    /**
     * 数据库配置名称
     */
    const Dbtabase = [
        'Dbtabase',
    ];
    /**
     * 错误与日志配置
     */
    const ErrorOrLog = [
        'ErrorOrLogConfig',
    ];
    /**
     * 部署配置
     */
    const Deploy = [
        'Deploy',
    ];

    /**
     * @var App|null 
     */
    protected $app = null;
    /**
     * InitializeConfig constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * 获取配置
     * @return mixed
     * @throws \ReflectionException
     */
    public function get_deploy_const()
    {
        return $this->get_foreach_const(self::Deploy);
    }

    /**
     * 获取配置
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public function get_config_const()
    {
        return $this->get_foreach_const(self::configName);
    }

    /**
     * 获取配置
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public function get_dbtabase_const()
    {
        return $this->get_foreach_const(self::Dbtabase);
    }

    /**
     * 获取配置 错误与日志配置
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public function get_error_log_const()
    {
        return $this->get_foreach_const(self::ErrorOrLog);
    }
    /**
     * @Author pizepei
     * @Created 2019/2/16 15:34
     * @param $data
     * @return array
     * @throws \ReflectionException
     * @title  批量获取日志
     *
     */
    public function get_foreach_const($data)
    {
        $Config =[];
        foreach($data as $key=>$value){
            $reflect = new \ReflectionClass('normphp\config\\'.$value);
            $Config = array_merge_recursive($Config, $reflect->getConstants());
        }
        return $Config;
    }

    /**
     * 获取配置(自定义)
     *
     * @param $name
     * @return mixed
     * @throws \ReflectionException
     */
    public function get_const(string $name):array
    {
        $reflect = new \ReflectionClass($name);
        return $reflect->getConstants();
    }

    /**
     * @param string $path
     * @param string $name
     * @param string $namespace
     * @param string $title
     */
    public function get_package_config($name,$path,$namespace='',$title='包配置')
    {
        $date = date('Y-m-d H:i:s');
        $time = time();
        $data = $this->get_package_config_str($name,$namespace,$title,$date,$time);
        file_put_contents($path.$name.'.php',$data);
        if (!empty($data)){
            return true;
        }
        return false;
    }

    /**
     * 获取模块配置模板
     */
    public function get_package_config_str($name,$namespace,$title,$date,$time,$appid='')
    {
        $this->app->Helper()->getFilePathData($this->app->DOCUMENT_ROOT.'vendor',$pathData,'ConfigTpl.php','namespaceConfigTplPath.json');
        # 准备头信息
        $str = '';
        $this->set_ClassHead($str,$name,$namespace,$title,$date,$time,$appid);
        if (!empty($pathData) && is_array($pathData)){
            foreach ($pathData as $key=>$value){
                $useNamespace = '';
                $this->app->Helper()->getUseNamespace($this->app->DOCUMENT_ROOT,$value['path'],$useNamespace);
                $packageInfo = json_decode($value['packageInfo'],true);
                if (!empty($value['packageInfo']) && $packageInfo===null){
                    throw new \Exception(' error packageInfo '.$value['path'].'->/namespaceConfigTplPath.json');
                }
                $constData = $this->get_const($useNamespace);
                if (!empty($packageInfo) && !empty($constData)){
                    if (!isset($packageInfo['prefix']) || empty($packageInfo['prefix'])){error('prefix是必须的：'.$useNamespace.'->namespaceConfigTplPath.json');}
                    # 处理信息
                    $constArray = [];
                    $contesExplain = [];
                    foreach ($constData as $cKey=>$value)
                    {
                        # 拼接处理 key
                        $constKey = $packageInfo['prefix'].'_'.$cKey;
                        $constArray[$constKey] = $value;
                        if (isset($packageInfo['contesExplain'][$cKey]))
                        {
                            $contesExplain[$constKey] = $packageInfo['contesExplain'][$cKey];
                        }
                        unset($constData[$cKey]);
                    }
                    # 提示信息
                    $this->setConstNotes($str,$packageInfo);
                    # 配置信息
                    $this->set_constContent($constArray,$str,$contesExplain??[]);
                }
            }
        }
        # 拼接
        $str .=PHP_EOL.PHP_EOL.'}';
        return $str;
    }

    /**
     * 简单处理提示信息
     * @param $str
     * @param $data
     */
    public function setConstNotes(&$str,$data)
    {
        $nbsp = '    ';
        $str .= PHP_EOL.PHP_EOL;
        $str .= $nbsp.'/**'.PHP_EOL;
        $str .= $nbsp.'* prefix: '.($data['prefix']??'').PHP_EOL;
        $str .= $nbsp.'* notes: '.($data['notes']??'').PHP_EOL;
        $str .= $nbsp.'* author: '.($data['author']??'').PHP_EOL;
        $str .= $nbsp.'* explain: '.($data['explain']??'').PHP_EOL;
        $str .= $nbsp.'**/'.PHP_EOL.PHP_EOL;

    }
    /**
     * @title  创建写入class配置文件
     * @param string $name
     * @param array $data
     * @param string $path
     * @param string $namespace
     * @param string $title
     * @param string $date
     * @param int $time
     * @param string $appid
     */
    public function set_config(string $name,array $data, string $path, string $namespace = '', string $title='基础配置',string $date='',int $time=0,string $appid='')
    {
        $str = $this->setConfigString($name,$data,$namespace,$title,$date,$time,$appid);
        //写入文件
        Helper::file()->createDir($path);
        file_put_contents($path.$name.'.php',$str);
    }
    /**
     * @title  创建写入array配置文件
     * @param string $name
     * @param array $data
     * @param string $path
     * @param string $title
     * @param string $date
     * @param int $time
     * @param string $appid
     */
    public function set_arrayConfig(string $name,array $data,string $path,string $title='基础配置',string $date='',int $time=0,string $appid='')
    {
        $str = $this->setConfigString($name,$data,'',$title,$date,$time,$appid,'array');
        //写入文件
        Helper::file()->createDir($path);
        file_put_contents($path.$name.'.php',$str);
    }

    /**
     * 设置配置(获取字符串)
     * @param string $name
     * @param array $data
     * @param string $namespace
     * @param string $title
     * @param string $date
     * @param int $time
     * @param string $appid
     * @param string $type
     * @return string
     */
    public function setConfigString(string $name,array $data,string $namespace = '',string$title='基础配置',string $date='',$time=0,string $appid='',string $type='class')
    {
        $str = '';
        if ($type ==='class'){
            $this->set_ClassHead($str,$name,$namespace,$title,$date,$time,$appid);
            $this->set_constContent($data,$str);
            $str .= PHP_EOL.PHP_EOL.'}';
        }else{
            $this->set_ArrayHead($str,$name,$namespace,$title,$date,$time,$appid);
            $str .= $this->arrayToString($data).';';
        }
        return $str;
    }


    /**
     * 设置CLASS文件头部
     * @param $str
     * @param $name
     * @param $namespace
     */
    public function set_ClassHead(&$str,$name,$namespace,$title,$date,$time,$appid)
    {
        if ($date == ''){$date = date('Y-m-d H:i:s');}
        if ($time == ''){$time = time();}

        $str = '<?php'.PHP_EOL;
        $str .= '/**'.PHP_EOL;
        $str .= ' * creationDate: '.$date.PHP_EOL;
        $str .= ' * creationTime: '.$time.PHP_EOL;
        $str .= ' * @title: '.$title.PHP_EOL;
        $str .= ' * @appid: '.$appid.PHP_EOL;
        $str .= ' */'.PHP_EOL.PHP_EOL.PHP_EOL;
        if(!empty($namespace)){
            $str .= ' namespace '.$namespace.';'.PHP_EOL.PHP_EOL.PHP_EOL;
        }

        $str .= 'class '.$name.PHP_EOL;
        $str .= '{ '.PHP_EOL;
    }


    /**
     * 设置CLASS文件头部
     * @param $str
     * @param $name
     * @param $namespace
     */
    public function set_ArrayHead(&$str,$name,$namespace,$title,$date,$time,$appid)
    {
        if ($date == ''){$date = date('Y-m-d H:i:s');}
        if ($time == ''){$time = time();}

        $str = '<?php'.PHP_EOL;
        $str .= '/**'.PHP_EOL;
        $str .= ' * creationDate: '.$date.PHP_EOL;
        $str .= ' * creationTime: '.$time.PHP_EOL;
        $str .= ' * @title: '.$title.PHP_EOL;
        $str .= ' * @appid: '.$appid.PHP_EOL;
        $str .= ' */'.PHP_EOL.PHP_EOL.PHP_EOL;
        $str .='return ';
    }

    /**
     * 设置常量
     * @param $data
     * @param $str
     */
    public function set_constContent($data,&$str,$contesExplain=[])
    {
        foreach($data as $key=>$vla){
            if (isset($contesExplain[$key]) && !empty($contesExplain[$key])){
                $str .= '    /**'.PHP_EOL;
                $str .= '    * '.$contesExplain[$key].PHP_EOL;
                $str .= '    **/'.PHP_EOL;
            }
            if(is_array($vla)){
                $str .= '    const '.$key.' = '.static::arrayToString($vla,1).';'.PHP_EOL.PHP_EOL;
            }else if(is_bool($vla)){
                if($vla){
                    $str .= '    const '.$key.' = TRUE;'.PHP_EOL.PHP_EOL;
                }else{
                    $str .= '    const '.$key.' = FALSE;'.PHP_EOL.PHP_EOL;
                }
            }else if(is_string($vla)){
                    $str .= '    const '.$key." = '".$vla."';".PHP_EOL.PHP_EOL;
            }else if(is_int($vla)){
                $str .= '    const '.$key.' = '.$vla.';'.PHP_EOL.PHP_EOL;
            }
        }
        # $str .=PHP_EOL.PHP_EOL.'}';
    }
    /**
     * 将数组转为字符串
     *
     * @param array  $data
     * @param int    $level
     * @param string $content
     * @param bool   $assoc
     * @param string $space
     * @return string
     */
    public static function arrayToString(array $data, $level = 1, $content = '', $assoc = false, $space = '    ')
    {
        $content   .= "[\n";
        $maxLength = 1;
        $index     = 0;
        $inAssoc = false;
        foreach($data as $key => $item){
            if($key !== $index){
                $inAssoc = true;
            }else{
                $index++;
            }
            $maxLength = max($maxLength, strlen((string)$key));
        }

        $index = count($data);
        foreach($data as $key => $item){
            $index--;
            $content .= str_repeat($space, $level);
            if(!is_int($key) || $assoc || $inAssoc){
                if(is_int($key)){
                    $content .= "$key".str_repeat(' ', $maxLength - strlen((string)$key) + 1)."=> ";
                }else{
                    $content .= "'$key'".str_repeat(' ', $maxLength - strlen((string)$key) + 1)."=> ";
                }
            }
            if(is_array($item)){
                $content .= self::arrayToString($item, $level + 1, '', $assoc, $space);
            }elseif(is_null($item)){
                $content .= "null";
            }else{
                $content .= var_export($item, true);
            }
            $content .= ($index? ',': '')."\n";
        }
        $content .= str_repeat($space, $level - 1)."    ]";

        return $content;
    }


}