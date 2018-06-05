<?php
namespace Lbs;

/**
 * 终端管理类
 * Class LbsEntity
 * @author sheply
 * @email sheply@hotmail.com
 * @date 2018-5-23
 */
class LbsEntity extends LbsService {

    public function __construct($service_id)
    {
        parent::__construct();
        $this->setApiUrl('http://yingyan.baidu.com/api/v3/entity/');
        $this->setService($service_id);
    }


    /**
     * 轨迹查询与纠偏
     * @param $filter
     * @param string $coord_type_output
     * @param int $page_index
     * @param int $page_size
     * @return bool|mixed
     */
    public function getEntityList($filter = '', $page_index = 1, $page_size = 100, $coord_type_output = 'bd09ll')
    {
        $data = [
            'filter' => $filter,
            'coord_type_output' => $coord_type_output,
            'page_index' => $page_index,
            'page_size' => $page_size
        ];
        return $this->get('list', $data);
    }
}