<?php
//tạo hàm tính tổng của 2 số
function tinh_tong($a, $b)
{
    echo $a + $b;
}

function tinh_tong2($a, $b)
{
    return $a + $b;
}

function kiem_tra()
{
    global $soa;
    $soa++;
    echo "<br> soa = " . $soa;
}

function tinh_tong_nhieu_so()
{
    $arr = func_get_args();
    $t = 0;
    $s = "";
    for ($i = 0; $i < count($arr); $i++) {
        $t += $arr[$i];
        $s .= $arr[$i] . " + ";
    }
    $s = rtrim($s, " + ");
    return $s . " = " . $t;
}
//Sử dụng hàm
$soa = 10;
$sob = 12.3;
tinh_tong($soa, $sob);
echo "<br>" . tinh_tong2($soa, $sob);
kiem_tra();
echo "<br>";
echo "Tổng các số = " . tinh_tong_nhieu_so(1, 2, 34.3, 43, 5, 3, 4.44);
