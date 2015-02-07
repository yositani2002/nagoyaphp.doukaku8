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
class MapResolver {
    public function estimate(Map $map)
    {
        foreach($map->getPoints() as $point)
        {
            $this->estimateOne($map, $point);
        }
    }

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
                    $this->estimateOne($map, $next_point);
                }
            }
        }

    }
}