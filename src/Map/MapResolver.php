<?php
/**
 * Created by PhpStorm.
 * User: taniguchi
 * Date: 2/7/15
 * Time: 13:43
 */

namespace nagoyaphp\doukaku8\Map;

/*
 * mapの中のpointを評価し、pointに評価値を与えていく。
 * 評価する人そのもの。
 *
 */
/**
 * Class MapResolver
 * @package nagoyaphp\doukaku8\Map
 */
class MapResolver {

    /**
     * 外部から実行する評価を算出するメソッド
     * 内部的にestimateOneを呼び出し、再帰的に処理を行う。
     *
     * @param Map $map
     */
    public function estimate(Map $map)
    {
        foreach($map->getPoints() as $point)
        {
            //端っこでどこにも行けないやつは評価外。
            /* @var $point Point */
            if($point->isEnd())
            {
                continue;
            }
            $this->estimateOne($map, $point);
        }
    }

    /**
     * 自分の上下左右の値が大きければそのマス（Point)の評価値を上げていく。
     * 再帰的に処理をする。
     * 戻り値として最後のポイントを返す。
     *
     * @param Map $map
     * @param Point $start_point
     */
    private function estimateOne(Map $map, Point &$start_point)
    {
        //次がある場合は次のポイントの評価値を自分の評価値+1する。
        $next_point_array = $map->getNext($start_point);

        if(is_array($next_point_array) && empty($next_point_array) === false)
        {
            //複数ある場合もあるのでhasNextはPointの配列を返すものとする。
            foreach($next_point_array as $next_point)
            {
                //ただし、評価値が自分のものより高い場合は何もしない。
                /* @var $next_point Point */
                if($next_point->getEstimate() < $start_point->getEstimate() + 1)
                {
                    $next_point->setEstimate($start_point->getEstimate() + 1);

                    //戻り値として最終到達点を設定
                    $this->estimateOne($map, $next_point);
                }
            }
        }
        else
        {
            $start_point->setEnd(true);
        }
    }
}