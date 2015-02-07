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
class Point {

    private $id;
    private $row;
    private $col;
    private $value;
    private $estimate = 1;

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

}