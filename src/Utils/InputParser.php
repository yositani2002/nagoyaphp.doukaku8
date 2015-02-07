<?php
/**
 * Created by PhpStorm.
 * User: taniguchi
 * Date: 2/7/15
 * Time: 14:00
 */
namespace nagoyaphp\doukaku8\Utils;
class InputParser {

    /**
     * 文字をパースして配列を返す。
     *
     * @param $input
     * @return array
     */
    public static function parse($input)
    {
        $array = array();
        $row_string = explode('/', $input);
        foreach($row_string as $row)
        {
            $array[] = str_split($row);
        }
        return $array;
    }
}