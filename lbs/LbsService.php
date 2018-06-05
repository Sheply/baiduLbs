<?php
namespace Lbs;
/**
 * 鹰眼接口请求类
 * Class LbsService
 * @author sheply
 * @email sheply@hotmail.com
 * @date 2018-5-22
 */
class LbsService {
    // 接口地址
    private $api_url = '';

    // AK
    private $ak = 'YOUR AK';

    // 服务ID
    private $service_id = 0;

    // entity名
    private $entity_name = 0;

    public function __construct()
    {
    }

    /**
     * 设定service_id
     * @param $service_id
     */
    public function setService($service_id)
    {
        $this->service_id = $service_id;
    }

    /**
     * 设定entity_name
     * @param $entity_name
     */
    public function setEntity($entity_name)
    {
        $this->entity_name = $entity_name;
    }

    /**
     * 设定api_url
     * @param $api_url
     */
    public function setApiUrl($api_url)
    {
        $this->api_url = $api_url;
    }

    /**
     * 模拟post请求
     * @param $method
     * @param array $data
     * @return array
     */
    protected function post($method,$data=array())
    {
        $data['ak'] = $this->ak;
        if($this->service_id > 0){
            $data['service_id'] = $this->service_id;
        }
        $url = $this->api_url.$method;
        return $this->curl($url,$data);
    }

    /**
     * 模拟get请求
     * @param $method
     * @param array $data
     * @return array
     */
    protected function get($method,$data=array())
    {
        $url = $this->api_url.$method;
        $requestStr = 'ak='.$this->ak;
        $requestStr = $this->service_id == 0 ? $requestStr : $requestStr.'&service_id='.$this->service_id;
        $requestStr = $this->entity_name == 0 ? $requestStr : $requestStr.'&entity_name='.$this->entity_name;
        foreach ($data as $key=>$val)
        {
            $requestStr .= "&$key=".$val;
        }
        $url .= '?'.$requestStr;
        return $this->curl($url);
    }

    /**
     * CURL请求鹰眼接口
     * @param $url
     * @param array $data
     * @return array
     */
    private function curl($url,$data = [])
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        $output = curl_exec($curl);
        curl_close($curl);

        $output = json_decode($output, true);
        if (!empty($output) && $output['status'] == 0) {
            return $output;
        } else {
            return false;
        }
    }
}