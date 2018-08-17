<?
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

function database_query($field_name, $synonyms)
{
    $result = "";

    if(count($synonyms) != 0)
    {
        $result = " (`$field_name` LIKE '%$synonyms[0]%'";

        for($i = 1; $i < count($synonyms); ++$i)
        {
            $result .= " OR `$field_name` LIKE '%$synonyms[$i]%'";
        }
        $result .= ")";

    }
    return $result;
}


function search ($name,$code,$manuscript,$info,$bibliography) 
{ 

    $name = trim($name); 
    $name = mysql_real_escape_string($name);
    $name = htmlspecialchars($name);

    $code = trim($code); 
    $code = mysql_real_escape_string($code);
    $code = htmlspecialchars($code);

    $manuscript = trim($manuscript); 
    $manuscript = mysql_real_escape_string($manuscript);
    $manuscript = htmlspecialchars($manuscript);

    $info = trim($info); 
    $info = mysql_real_escape_string($info);
    $info = htmlspecialchars($info);

    $bibliography = trim($bibliography); 
    $bibliography = mysql_real_escape_string($bibliography);
    $bibliography = htmlspecialchars($bibliography);

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

    $synonyms1 = $groups[$dict[$name]];
    $synonyms2 = $groups[$dict[$code]];
    $synonyms3 = $groups[$dict[$manuscript]];
    $synonyms4 = $groups[$dict[$info]];
    $synonyms5 = $groups[$dict[$bibliography]];

    if ( !(empty($name) && empty($code) && empty($manuscript) && empty($info) && empty($bibliography)) ) 
    { 
        if (strlen($name) > 128 || strlen($code) > 128 || strlen($manuscript) > 128 || strlen($info) > 128 || strlen($bibliography) > 128) 
        {
            $text = '<p>Слишком длинный поисковый запрос.</p>';
        } 
        else 
        { 

            $head = "SELECT * FROM `list` WHERE";
            $tail = "";

            if( !empty($name) )
            {
                if($synonyms1 != "")
                {
                    $tail .= database_query("name", $synonyms1);
                }
                else
                {
                    $tail .= database_query("name", array($name) );
                }
            }

            if( !empty($code))
            {
                if($tail != "") $tail .= " AND";

                if($synonyms2 != "")
                {
                    $tail .= database_query("code", $synonyms2);
                }
                else
                {
                    $tail .= database_query("code", array($code) );
                }
            }

            if( !empty($manuscript))
            {
                if($tail != "") $tail .= " AND";

                if($synonyms3 != "")
                {
                    $tail .= database_query("manuscript", $synonyms3);
                }
                else
                {
                    $tail .= database_query("manuscript", array($manuscript) );
                }
            }

            if( !empty($info))
            {
                if($tail != "") $tail .= " AND";

                if($synonyms4 != "")
                {
                    $tail .= database_query("info", $synonyms4);
                }
                else
                {
                    $tail .= database_query("info", array($info) );
                }
            }

            if( !empty($bibliography))
            {
                if($tail != "") $tail .= " AND";

                if($synonyms5 != "")
                {
                    $tail .= database_query("bibliography", $synonyms5);
                }
                else
                {
                    $tail .= database_query("bibliography", array($bibliography) );
                }
            }

            $q = $head . $tail;
        
            //echo $q;
            $result = mysql_query($q);

            if (mysql_affected_rows() > 0) { 
                $row = mysql_fetch_assoc($result); 
                $num = mysql_num_rows($result);

                $text = '<p class="attention">По запросу <b>'.$name.' '.$code.' '.$manuscript.' '.$info. ' '.$bibliography.'</b> найдено совпадений: '.$num.'</p>';
                echo '<table>';
                echo '<thead><tr><td>Название произведения</td><td>Шифр рукописи</td><td>Сведения о рукописи</td><td>Заглавие</td><td>Библиография</td></tr></thead>';

                do {
        
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
if (!empty($_POST['name']) || !empty($_POST['code']) || !empty($_POST['manuscript']) || !empty($_POST['info']) || !empty($_POST['bibliography'])) { 
    $search_result = search ($_POST['name'], $_POST['code'],$_POST['manuscript'],$_POST['info'],$_POST['bibliography'] ); 
    echo $search_result; 
}?>
