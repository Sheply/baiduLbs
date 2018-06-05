<?php
namespace Lbs;

/**
 * 轨迹查询类
 * Class LbsTrack
 * @author sheply
 * @email sheply@hotmail.com
 * @date 2018-5-22
 */
class LbsTrack extends LbsService {

    public function __construct($service_id, $entity)
    {
        parent::__construct();
        $this->setApiUrl('http://yingyan.baidu.com/api/v3/track/');
        $this->setService($service_id);
        $this->setEntity($entity);
    }

    /**
     * 查询某 entity 的实时位置
     * @param $need_denoise (need_denoise =0：不去噪 need_denoise =1：去噪)
     * @param $need_mapmatch (need_mapmatch=0：不绑路 need_mapmatch=1：绑路)
     * @param $radius_threshold (radius_threshold=0：不过滤 radius_threshold=100：过滤)
     * @param $transport_mode (transport_mode=auto transport_mode=driving transport_mode=riding transport_mode=walking)
     * @param $coord_type_output (返回的坐标类型)
     * @return array
     */
    public function getLatestPoint($need_denoise = 1, $need_mapmatch = 0, $radius_threshold = 0, $transport_mode = 'driving', $coord_type_output = 'bd09ll')
    {
        $data = [
            'process_option' => "need_denoise=$need_denoise,need_mapmatch=$need_mapmatch,radius_threshold=$radius_threshold,transport_mode=$transport_mode",
            'coord_type_output' => $coord_type_output
        ];
        return $this->get('getlatestpoint', $data);
    }

    /**
     * 查询轨迹里程
     * @param $start_time
     * @param $end_time
     * @param $is_processed
     * @param int $need_denoise
     * @param int $need_mapmatch
     * @param int $radius_threshold
     * @param string $transport_mode
     * @param string $supplement_mode
     * @return bool|mixed
     */
    public function getDistance($start_time, $end_time, $is_processed, $need_denoise = 1, $need_mapmatch = 0, $radius_threshold = 0, $transport_mode = 'driving', $supplement_mode = 'no_supplement')
    {
        $data = [
            'start_time' => $start_time,
            'end_time' => $end_time,
            'is_processed' => $is_processed,
            'process_option' => "need_denoise=$need_denoise,need_mapmatch=$need_mapmatch,radius_threshold=$radius_threshold,transport_mode=$transport_mode",
            'supplement_mode' => $supplement_mode
        ];
        return $this->get('getdistance', $data);
    }

    /**
     * 轨迹查询与纠偏
     * @param $start_time
     * @param $end_time
     * @param $is_processed
     * @param int $need_denoise
     * @param int $need_mapmatch
     * @param int $radius_threshold
     * @param string $transport_mode
     * @param string $supplement_mode
     * @param string $coord_type_output
     * @param string $sort_type
     * @param int $page_index
     * @param int $page_size
     * @return bool|mixed
     */
    public function getTrack($page_index = 1, $page_size = 100, $start_time, $end_time, $is_processed, $need_denoise = 1, $need_mapmatch = 0, $radius_threshold = 0, $transport_mode = 'driving', $supplement_mode = 'no_supplement', $coord_type_output = 'bd09ll', $sort_type = 'asc')
    {
        $data = [
            'start_time' => $start_time,
            'end_time' => $end_time,
            'is_processed' => $is_processed,
            'process_option' => "need_denoise=$need_denoise,need_mapmatch=$need_mapmatch,radius_threshold=$radius_threshold,transport_mode=$transport_mode",
            'supplement_mode' => $supplement_mode,
            'coord_type_output' => $coord_type_output,
            'sort_type' => $sort_type,
            'page_index' => $page_index,
            'page_size' => $page_size
        ];
        return $this->get('gettrack', $data);
    }
}