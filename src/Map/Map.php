<?php
/**
 * Created by PhpStorm.
 * User: taniguchi
 * Date: 2/7/15
 * Time: 13:42
 */
namespace nagoyaphp\doukaku8\Map;
/*
 * Pointを配列で持つ。
 * マップの値を保持する。
 * 特定のマスの上下左右の値を返す。
 *
 * Class Map
 * @package nagoyaphp\doukaku8\Map
 */
/**
 * Class Map
 * @package nagoyaphp\doukaku8\Map
 */
class Map {
    /**
     * @var
     */
    private $points;

    public function reset()
    {
        $this->points = null;
    }

    /**
     * 配列を設定すると内部でPointクラスの配列に変換して保持する。
     *
     * @param array $input
     */
    public function setValues(array $input)
    {
        foreach($input as $row => $row_val)
        {
            foreach($row_val as $col => $value)
            {
                $this->points[] = new Point($row, $col, $value);
            }
        }
    }

    /**
     * マップにセットされているPointクラスの配列を返す
     * idを指定した場合はそのマスにあるPointクラスを返す。
     *
     * @param $id
     * @return array|Point
     */
    public function getPoints($id = null)
    {
        if($id === null)
        {
            return $this->points;
        }
        else
        {
            return $this->points[$id];
        }
    }

    /**
     * 設定されているPointで最大の評価値を持っているものを返す
     *
     * @return Point
     */
    public function getMaxPoint()
    {
        /* @var $max Point */
        $max = null;
        foreach($this->getPoints() as $point)
        {
            /* @var $point Point */
            if($max == null || $max->getEstimate() < $point->getEstimate())
            {
                $max = $point;
            }
        }
        return $max;
    }

    /**
     * ポイントを指定した場合、その指定したポイントの上下左右のポイントの値を判定し、
     * 値が大きいものが一つでもあればそのPointを配列に格納して返す。
     * 空の配列が入る事もある。
     *
     * @param Point $point
     * @return array
     */
    public function getNext(Point $point)
    {
        $next = array();
        $enable_id = $this->getAvailableId($point);
        if(is_null($enable_id) === false && empty($enable_id) === false)
        {
            foreach($enable_id as $point_id)
            {
                $test_point = $this->getPoints($point_id);
                if($test_point->getValue() > $point->getValue())
                {
                    $next[] = $test_point;
                }
            }
        }
        return $next;
    }

    /**
     * @param Point $point
     * @return array
     */
    private function getAvailableId(Point $point)
    {
        $return = array();
        //与えられたpointから上下左右のポイントのIDを判定
        $id = $point->getId();
        //上、5を引いた数字。ただし、4以下はない。
        if($id > 4){
            $return[] = $id - 5;
        }
        //右、1を足した数字。ただし、5の剰余が4の場合は無い。
        if($id % 5 !== 4)
        {
            $return[] = $id + 1;
        }
        //左、1を引いた数字。ただし、5の剰余が0の場合は無い。
        if($id % 5 !== 0)
        {
            $return[] = $id - 1;
        }
        //下、5を足した数字。ただし、20以上はない。
        if($id < 20)
        {
            $return[] = $id + 5;
        }
        return $return;
    }

}