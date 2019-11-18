<?php
function print_list($page)
{

    $list = scandir('./data');
    $listResult = array_diff($list, array('.', '..'));
    $listResult = array_values($listResult);
    $lastPage = floor(count($listResult) / 10) + 1;
    $selectStart = count($listResult) - 10 * ($page - 1);
    $selectEnd = count($listResult) - 10 * ($page);
    for ($count = $selectStart; $count > $selectEnd; $count--) {

        if ($count == 0) {
            break;

        }
        else{

            echo '
                <tr>
                
                    <th scope="row" class="mobile" style="text-align:center;">' . ($count) . '</th>
                    
                    <td><a href="../boardView.php?id=' . $listResult[$count - 1] . '" style="color: #000000;">' . $listResult[$count - 1] . '</a></td>
<!--
<td class="mobile" style="text-align:center;">' . $page . '</td>
                    <td class="mobile" style="text-align:center;">2018-01-05</td>
-->
                </tr>
                ';
        }
    }


}
function get_this_page(){

    //getPage 하는데 없으면 1페이지를 반환
    if (isSet($_GET['page'])) {
        return $_GET['page'];
    } else {
        return 1;
    }

}

?>
