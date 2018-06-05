<?php
require_once 'autoload.php';
use Lbs\LbsEntity;
use Lbs\LbsTrack;
use Lbs\LbsAnalysis;

/**
 * 接口测试类
 * Class Test
 */
class Test {
    private $entity;
    private $track;
    private $analysis;
    function __construct()
    {
        // 终端管理类实例化
        $this->entity = new LbsEntity(165286);
        // 轨迹查询类实例化
        $this->track = new LbsTrack(165286, '14142730522');
        // 轨迹分析类实例化
        $this->analysis = new LbsAnalysis(165286, '14142730522');
    }

    /**
     * 获取终端列表
     * @return bool|mixed
     */
    function getEntityList()
    {
        $result = $this->entity->getEntityList("entity_names:14142730522");
        return $result;
    }

    /**
     * 查询某 entity 的实时位置
     * @return array
     */
    function getLatestPoint()
    {
        $result = $this->track->getLatestPoint();
        return $result;
    }

    /**
     * 查询某 entity 轨迹里程
     * @return bool|mixed
     */
    function getDistance()
    {
        $now = time();
        $result = $this->track->getDistance($now-60*60, $now, 1);
        return $result;

    }

    /**
     * 轨迹查询与纠偏
     * @return bool|mixed
     */
    function getTrack()
    {
        $now = time();
        $result = $this->track->getTrack(1, 300, 1526158800, 1526169600, 1, 1, 1, 20, 'driving', 'driving', 'bd09ll', 'desc');
        return $result;
    }

    /**
     * 停留点查询
     * @return array
     */
    function stayPoint()
    {
        $now = time();
        $result = $this->analysis->stayPoint($now-60*60, $now);
        return $result;
    }

    /**
     * 驾驶行为分析
     * @return array
     */
    function drivingBehavior()
    {
        $now = time();
        $result = $this->analysis->drivingBehavior($now-60*60, $now);
        return $result;
    }

}

$test = new Test();
$result = $test->getTrack();
$h[] = ['lng' => $result['end_point']['longitude'], 'lat' => $result['end_point']['latitude']];
foreach ($result['points'] as $value) {
    $h[] = ['lng' => $value['longitude'], 'lat' => $value['latitude']];
}
$h[] = ['lng' => $result['start_point']['longitude'], 'lat' => $result['start_point']['latitude']];
echo(json_encode($h));exit;