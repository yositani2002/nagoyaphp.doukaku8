<?php
/**
 * Created by PhpStorm.
 * User: taniguchi
 * Date: 2/7/15
 * Time: 14:02
 */
namespace nagoyaphp\doukaku8\Map;

/*
* ポイント、マス。
* マスは評価値を持つ。
* 上下左右のつながりから、評価値をMapResolverが設定する。
*/
/**
 * Class Point
 * @package nagoyaphp\doukaku8\Map
 */
class Point {

    /**
     * マスのID
     * @var int
     */
    private $id;
    /**
     * 縦
     * @var
     */
    private $row;
    /**
     * 横
     * @var
     */
    private $col;
    /**
     * マスの値
     * @var
     */
    private $value;
    /**
     * 評価値
     * @var int
     */
    private $estimate = 1;
    /**
     * 何処にも行く事の無いマスの場合はtrueにする。
     * @var bool
     */
    private $end=false;

    /**
     * @param $row
     * @param $col
     * @param $value
     */
    function __construct($row, $col, $value)
    {
        $this->id =  5 * $row + $col;
        $this->row = $row;
        $this->col = $col;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getEstimate()
    {
        return $this->estimate;
    }

    /**
     * @param mixed $estimate
     */
    public function setEstimate($estimate)
    {
        $this->estimate = $estimate;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * @return mixed
     */
    public function getCol()
    {
        return $this->col;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return boolean
     */
    public function isEnd()
    {
        return $this->end;
    }

    /**
     * @param boolean $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }

}