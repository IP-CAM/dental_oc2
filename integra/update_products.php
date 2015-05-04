<?php

/*
 * @author Ali Abbas
 * @purpose update all older producs according to sidicom
 */

$test_s = "CER S-BASE SBA1 (10G)";
$unique_field = 'name';

function str_replace_first($search, $replace, $subject) {
    $pos = strpos($subject, $search);
    if ($pos !== false) {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }
    return $subject;
}

$testk = '(01010034) CZR DENTINA A4B (10G)';

include_once('chaveiro.php');

$sql = 'Select p.product_id,p.unique_name,p.group_name,pd.name FROM ' . $db_prefix . 'product p';
$sql.= ' INNER JOIN ' . $db_prefix . 'product_description pd on pd.product_id = p.product_id';
$sql_res = mysqli_query($conexao, $sql);
$i = 0;

while ($row = mysqli_fetch_assoc($sql_res)) {
    $product_id = $row['product_id'];
//    print_r($row);
    preg_match_all('/\(([A-Za-z0-9 ]+?)\)/', $row[$unique_field], $out);
    echo "<pre>";
    print_r($out[0]);
    echo "</pre>";
    echo "<br/>";
    $product_name = $row[$unique_field];
    if (!empty($out) && $out[0]) {
        $product_name = str_replace_first($out[0][0], "", $row[$unique_field]);
        if (!empty($out[0][1])) {
            $product_name = str_replace_first($out[0][1], "", $product_name);
            $product_arr = explode(' ', $product_name);

            unset($product_arr[count($product_arr) - 1]);
            echo $product_name = implode(" ", $product_arr);
            echo "<br/>";
            $group_name = substr($product_name, 0, strlen($product_name) - 1);
            echo "<br/>";
            $group_name = trim($group_name);
            echo $group_name;
        } else {
            echo "<br/>---------else-------- <br/>";
            echo $product_name;
            $group_split = explode(" ", $row[$unique_field]);


            if (count($group_split) == 8) {
                unset($group_split[7]);
                unset($group_split[6]);
                unset($group_split[5]);
                $group_name = implode(" ", $group_split);
            } else if (count($group_split) == 7) {
                unset($group_split[6]);
                unset($group_split[5]);
                $group_name = implode(" ", $group_split);
            } else if (count($group_split) == 6) {
                unset($group_split[5]);
                $group_name = implode(" ", $group_split);
            } else {
                $group_name = substr($product_name, 0, strlen($product_name) - 1);
            }

            $group_name = str_replace_first($out[0][0], "", $group_name);
            $group_name = trim($group_name);
            echo "<br/>";
            echo $group_name;
        }
    }

    //seting group to just only two words
    $group_split = explode(" ", $group_name);
    $g = 0;
    foreach ($group_split as $group) {
        if ($g > 1) {
          unset($group_split[$g]);  
        }
        $g++;
    }
    $group_name = implode(" ",$group_split);

    echo "<br/>";
    $i++;

    $sql = "UPDATE " . $db_prefix . "product SET unique_name = '$row[$unique_field]',group_name='$group_name' WHERE product_id = '$product_id'";

    echo $sql;
   mysqli_query($conexao, $sql);

    echo "<br/>";
    $sql_des = "UPDATE " . $db_prefix . "product_description SET name = '$product_name' WHERE product_id = '$product_id'";
    echo $sql_des;
    mysqli_query($conexao, $sql_des);
}
echo "<br/>";
echo $i;
