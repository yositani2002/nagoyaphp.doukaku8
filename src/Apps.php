<?php
/**
 * Created by PhpStorm.
 * User: taniguchi
 * Date: 2/7/15
 * Time: 13:41
 */

namespace nagoyaphp\doukaku8;

use nagoyaphp\doukaku8\Map\MapResolver;
use nagoyaphp\doukaku8\Map\Map;
use nagoyaphp\doukaku8\Map\Point;
use nagoyaphp\doukaku8\Utils\InputParser;


/**
 * Class Apps
 * @package nagoyaphp\doukaku8
 */
class Apps {

    /**
     * @var Map\Map
     */
    private $map;

    /**
     * @var Map\MapResolver
     */
    private $map_resolver;


    function __construct(Map $map, MapResolver $map_resolver)
    {
        $this->map = $map;
        $this->map_resolver = $map_resolver;
    }

    private function reset()
    {
        $this->map->reset();
    }

    /**
     * 文字列を受け取って、input parserにて配列に変換。
     * マップクラスにセットする。
     * mapresolverでマップの中のマスを評価する。
     *
     * 最終的にステップ数を返す。
     *
     * @param $input
     * @return bool|integer
     */
    public function execute($input)
    {
        $this->reset();
        //入力をパースしてマップにセットする
        $this->map->setValues(InputParser::parse($input));

        //評価値を設定する
        $this->map_resolver->estimate($this->map);

        //評価値の最大値を算出する
        /* @var Point $result */
        $result = $this->map->getMaxPoint();

        return $result instanceof Point ? $result->getEstimate() : false;
    }

}