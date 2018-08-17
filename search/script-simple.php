<?php 
/*обработчик для профессионального поиска*/
define('DB_HOST', 'localhost'); /*значение по умолчанию*/
define('DB_USER', 'vh200034_nicol'); /*имя пользователя базой данных*/
define('DB_PASS', 'UGuJ2A0l'); /*пароль от базы данных*/
define('DB_NAME', 'vh200034_arch'); /*имя базы данных*/

if (!mysql_connect(DB_HOST, DB_USER, DB_PASS)) {
    exit('Cannot connect to server');
}
if (!mysql_select_db(DB_NAME)) {
    exit('Cannot select database');
}

mysql_query('SET NAMES utf8');

function search ($query) 
{ 
    $query = trim($query); 
    $query = mysql_real_escape_string($query);
    $query = htmlspecialchars($query);
   
 
    $data=file('data.csv'); 

    $groups = array();
    $dict = array();

    if (is_array($data)) 
    { 
        for($i = 0; $i < count($data); ++$i)
        {
            $full_strings = explode('|', $data[$i]);
            $without_null_string = array();

            foreach ($full_strings as $s) 
            {
                $temp = trim($s);

                if($temp != "")
                {
                    array_push($without_null_string, $temp);

                    $dict[$temp] = $i;
                }
            }

            array_push($groups, $without_null_string); 
        } 
    } 

    $synonyms = $groups[$dict[$query]] ;

    if (!empty($query)) 
    { 
        if (strlen($query) > 128) {
            $text = '<p>Слишком длинный поисковый запрос.</p>';
        } else { 

            $q = "SELECT `name`, `code`, `manuscript`, `info`, `bibliography` FROM `list` WHERE";

            if($synonyms != "")
            {
                $q .= " `name` LIKE '%$synonyms[0]%'
                    OR `code` LIKE '%$synonyms[0]%'
                    OR `manuscript` LIKE '%$synonyms[0]%'
                    OR `info` LIKE '%$synonyms[0]%'
                    OR `bibliography` LIKE '%$synonyms[0]%'" ;

                for($i = 1; $i < count($synonyms); ++$i)
                {
                    $q .= " OR `name` LIKE '%$synonyms[$i]%'
                        OR `code` LIKE '%$synonyms[$i]%'
                        OR `manuscript` LIKE '%$synonyms[$i]%'
                        OR `info` LIKE '%$synonyms[$i]%'
                        OR `bibliography` LIKE '%$synonyms[$i]%'" ;
                }
               
            }
            else
            {
                $q .= " `name` LIKE '%$query%'
                    OR `code` LIKE '%$query%'
                    OR `manuscript` LIKE '%$query%'
                    OR `info` LIKE '%$query%'
                    OR `bibliography` LIKE '>%$query%'" ;
            }

           //echo $q;

            $result = mysql_query($q);

            if (mysql_affected_rows() > 0) { 
                $row = mysql_fetch_assoc($result); 
                $num = mysql_num_rows($result);

                $text = '<p class="attention">По запросу <b>'.$query.'</b> найдено совпадений: '.$num.'</p>';
                echo '<table>';
                echo '<thead><tr><td>Название произведения</td><td>Шифр рукописи</td><td>Сведения о рукописи</td><td>Заглавие</td><td>Библиография</td></tr></thead>';

                do {

                    // $str = preg_replace('/('.preg_quote($query).')/i', "<b>$1</b>", $str);
                    // echo $str;

                    // $row['name'] = preg_replace('#'.$query.'#iu','<b class="light_world">'.$query.'</b>',$row['name']);
                    // $row['code'] = preg_replace('#'.$query.'#iu','<b class="light_world">'.$query.'</b>',$row['code']);
                    // $row['manuscript'] = str_ireplace($query,'<b class="light_world">'.$query.'</b>',$row['manuscript']);
                    // $row['info'] = str_ireplace($query,'<b class="light_world">'.$query.'</b>',$row['info']);
                    // $row['bibliography'] = str_ireplace($query,'<b class="light_world">'.$query.'</b>',$row['bibliography']);


                    $text .= '<tr><td>'.'<p>'.$row['name'].'</p>'.'</td><td>'.'<p> '.$row['code'].'</p>'.'</td><td>'.'<p>'.$row['manuscript'].'</p>'.'</td><td>'.'<p>'.$row['info'].'</p>'.'</td><td>'.'<p>'.$row['bibliography'].'</p>'.'</td></tr>';

                } while ($row = mysql_fetch_assoc($result)); 
            } else {
                $text = '<p>По вашему запросу ничего не найдено.</p>';
            }
        } 
    } else {
        $text = '<p>Задан пустой поисковый запрос.</p>';
    }

    return $text; 
    echo '</table>';
}?>

<?
if (!empty($_POST['query'])) { 
    $search_result = search ($_POST['query']); 
    echo $search_result; 
}?>