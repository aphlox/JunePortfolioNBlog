<?php
function print_list($page){

    $list = scandir('./data');
    $list_result = array_diff($list, array('.', '..'));
    $list_result = array_values($list_result);
    for ($count = $page; $count >= 0; $count--) {

        echo '
                <tr>
                    <th scope="row" class="mobile" style="text-align:center;">' . ($count+1) . '</th>
                    
                    <td><a href="../boardView.php?id='.$list_result[$count].'" style="color: #000000;">' . $list_result[$count] . '</a></td>
<!--
<td class="mobile" style="text-align:center;">'.$page.'</td>
                    <td class="mobile" style="text-align:center;">2018-01-05</td>
-->
                </tr>
                ';

    }


}

?>
