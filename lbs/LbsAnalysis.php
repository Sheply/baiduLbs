<?php
namespace Lbs;

/**
 * 轨迹分析类
 * Class LbsAnalysis
 * @author sheply
 * @email sheply@hotmail.com
 * @date 2018-5-22
 */
class LbsAnalysis extends LbsService {

    public function __construct($service_id, $entity)
    {
        parent::__construct();
        $this->setApiUrl('http://yingyan.baidu.com/api/v3/analysis/');
        $this->setService($service_id);
        $this->setEntity($entity);
    }

    /**
     * 停留点查询
     * @param $start_time
     * @param $end_time
     * @param $stay_time
     * @param $stay_radius
     * @param int $need_mapmatch
     * @param string $transport_mode
     * @param string $coord_type_output
     * @return array
     */
    public function stayPoint($start_time, $end_time, $stay_time = 600, $stay_radius = 20, $need_mapmatch = 0, $transport_mode = 'driving', $coord_type_output = 'bd09ll')
    {
        $data = [
            'start_time' => $start_time,
            'end_time' => $end_time,
            'stay_time' => $stay_time,
            'stay_radius' => $stay_radius,
            'process_option' => "need_mapmatch=$need_mapmatch,transport_mode=$transport_mode",
            'coord_type_output' => $coord_type_output
        ];
        return $this->get('staypoint', $data);
    }

    /**
     * 驾驶行为分析
     * @param $start_time
     * @param $end_time
     * @param int $speeding_threshold
     * @param float $harsh_acceleration_threshold
     * @param int $harsh_breaking_threshold
     * @param int $harsh_steering_threshold
     * @param int $need_mapmatch
     * @param string $transport_mode
     * @param string $supplement_mode
     * @return array
     */
    public function drivingBehavior($start_time, $end_time, $speeding_threshold = 0, $harsh_acceleration_threshold = 1.67, $harsh_breaking_threshold = -1.67, $harsh_steering_threshold = 5, $need_mapmatch = 0, $transport_mode = 'driving', $supplement_mode = 'no_supplement')
    {
        $data = [
            'start_time' => $start_time,
            'end_time' => $end_time,
            'speeding_threshold' => $speeding_threshold,
            'harsh_acceleration_threshold' => $harsh_acceleration_threshold,
            'harsh_breaking_threshold' => $harsh_breaking_threshold,
            'harsh_steering_threshold' => $harsh_steering_threshold,
            'process_option' => "need_mapmatch=$need_mapmatch,transport_mode=$transport_mode",
            'supplement_mode' => $supplement_mode
        ];
        return $this->get('drivingbehavior', $data);
    }

}