<?php


/**
* 
*/
class ArraySort
{
	
	 /**
     * 取汉字的第一个字的首字母
     * @param type $str
     * @return string|null
     */
    public static function getFirstCharter($str){
        if(empty($str)){return '';}
        $fchar=ord($str{0});
        if($fchar>=ord('A')&&$fchar<=ord('z')) return strtoupper($str{0});
        $s1=iconv('UTF-8','gb2312',$str);
        $s2=iconv('gb2312','UTF-8',$s1);
        $s=$s2==$str?$s1:$str;
        $asc=ord($s{0})*256+ord($s{1})-65536;
        $fir = strtoupper(substr($str, 0, 1));
        if (is_numeric($str)) return $fir;
        if(($asc>=-20319&&$asc<=-20284) || $fir == 'A') return 'A';
        if(($asc>=-20283&&$asc<=-19776) || $fir == 'B') return 'B';
        if(($asc>=-19775&&$asc<=-19219) || $fir == 'C') return 'C';
        if(($asc>=-19218&&$asc<=-18711) || $fir == 'D') return 'D';
        if(($asc>=-18710&&$asc<=-18527) || $fir == 'E') return 'E';
        if(($asc>=-18526&&$asc<=-18240) || $fir == 'F') return 'F';
        if(($asc>=-18239&&$asc<=-17923) || $fir == 'G') return 'G';
        if(($asc>=-17922&&$asc<=-17418) || $fir == 'H') return 'H';
        if(($asc>=-17417&&$asc<=-16475) || $fir == 'J') return 'J';
        if(($asc>=-16474&&$asc<=-16213) || $fir == 'K') return 'K';
        if(($asc>=-16212&&$asc<=-15641) || $fir == 'L') return 'L';
        if(($asc>=-15640&&$asc<=-15166) || $fir == 'M') return 'M';
        if(($asc>=-15165&&$asc<=-14923) || $fir == 'N') return 'N';
        if(($asc>=-14922&&$asc<=-14915) || $fir == 'O') return 'O';
        if(($asc>=-14914&&$asc<=-14631) || $fir == 'P') return 'P';
        if(($asc>=-14630&&$asc<=-14150) || $fir == 'Q') return 'Q';
        if(($asc>=-14149&&$asc<=-14091) || $fir == 'R') return 'R';
        if(($asc>=-14090&&$asc<=-13319) || $fir == 'S') return 'S';
        if(($asc>=-13318&&$asc<=-12839) || $fir == 'T') return 'T';
        if(($asc>=-12838&&$asc<=-12557) || $fir == 'W') return 'W';
        if(($asc>=-12556&&$asc<=-11848) || $fir == 'X') return 'X';
        if(($asc>=-11847&&$asc<=-11056) || $fir == 'Y') return 'Y';
        if(($asc>=-11055&&$asc<=-10247) || $fir == 'Z') return 'Z';
        return null;
    }

    /**
     * 二维数组，按字段排序，遇到中文会按拼音首字母排序
     * @param array $array
     * @param $column
     * @return array 去除key的二维数组
     */
    public static function sortByArrColumn(array $array, $column) {

        $new_array = [];
        $temp = [];
        foreach ($array as $item) {
            $sname = $item[$column];
            $snameFirstChar = self::getFirstCharter($sname); //取出门店的第一个汉字的首字母
            if (!$snameFirstChar) {
                $temp[] = $item;
            } else {
                $new_array[$snameFirstChar] = $item;//以这个首字母作为key
            }
        }
        ksort($new_array, SORT_NATURAL); //对数据进行ksort排序，以key的值升序排序

        return array_values($new_array) + $temp;
    }
}
   