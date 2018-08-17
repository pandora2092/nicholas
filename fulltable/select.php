<?
session_start();

if (isset($_POST['num'])) {
    $_SESSION['num'] = $_POST['num']; 
    $num = $_SESSION['num'];
}else {
    $num = $_SESSION['num'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Никольский</title>
    <link rel="stylesheet" href="../style.css">
    <!-- <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"> -->
    <link rel="stylesheet" href="../bootstrap/css/compiled.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="../bootstrap/js/jquery.js"></script> 
</head>

<body>
<header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-brown scrolling-navbar">
        <a class="navbar-brand" href="#"><strong></strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">О проекте <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/search">Поиск</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Обратная связь</a>
                </li>
            </ul>
            <ul class="navbar-nav nav-flex-icons">
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-facebook"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-twitter"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-instagram"></i></a>
                </li>
            </ul>
        </div>
    </nav>

</header>
    <div class="fon">

        <section class="section">
            <div class="container">
                <div class="show_number">
                    <span class="number_list">
                    <form action="index.php" method="post">
                       <select class="mdb-select" name="num">
                        <option value="" disabled selected>Показать по: </option>
                        <option value="20">20</option>
                        <option value="40">40</option>
                        <option value="60">60</option>
                        <option value="80">80</option>
                        <option value="100">100</option>
                    </select>
                    </select>
                    </select>
                       <p>
                       <input type="submit" value="Выбрать"></p>
                      </form>
                    </span>
                </div>
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

                echo $num;
                echo $_SESSION['num'];
               
                
                $page = $_GET['page'];  
                $result = mysql_query("SELECT COUNT(*) FROM list");  
                $posts = mysql_result($result, 0);  
                $total = intval(($posts - 1) / $num) + 1;  
                $page = intval($page);   
                if(empty($page) or $page < 0) $page = 1;  
                  if($page > $total) $page = $total;  
                $start = $page * $num - $num;  
                $result = mysql_query("SELECT * FROM list LIMIT $start, $num");  
                while ( $postrow[] = mysql_fetch_array($result))  
                ?>

             
                <?php 
                echo '<div class="table-responsive">';
                echo '<table class="filltable">';
                echo '<thead><tr><td>Название произведения</td><td>Шифр рукописи</td><td>Сведения о рукописи</td><td>Заглавние</td><td>Библиография</td></tr></thead>';  
                for($i = 0; $i < $num; $i++)  
                {  
                 echo '<tr><td>'.'<p>'.$postrow[$i]['name'].'</p>'.'</td><td>'.'<p> '.$postrow[$i]['code'].'</p>'.'</td><td>'.'<p>'.$postrow[$i]['manuscript'].'</p>'.'</td><td>'.'<p>'.$postrow[$i]['info'].'</p>'.'</td><td>'.'<p>'.$postrow[$i]['bibliography'].'</p>'.'</td></tr>'; 
                }  
                echo "</table>";  
                echo "</div>"; 
                ?>

                
             <nav>
                <ul class="pagination pg-teal pagination-lg">
                <?php  
                if ($page != 1) $pervpage = '<li class="page-item"><a class="page-link" href= ./?page=1><<</a><a class="page-link" href= ./?page='. ($page - 1) .'><</a></li> ';  
                if ($page != $total) $nextpage = ' <li class="page-item"><a class="page-link" href= ./?page='. ($page + 1) .'>></a><a class="page-link" href= ./?page=' .$total. '>>></a></li>';  

                // Находим две ближайшие станицы с обоих краев, если они есть  
                if($page - 5 > 0) $page5left = ' <li class="page-item"><a class="page-link" href= ./?page='. ($page - 5) .'>'. ($page - 5) .'</a></li>';  
                if($page - 4 > 0) $page4left = '<li class="page-item"><a class="page-link" href= ./?page='. ($page - 4) .'>'. ($page - 4) .'</a></li>'; 
                if($page - 3 > 0) $page3left = '<li class="page-item"><a class="page-link" href= ./?page='. ($page - 3) .'>'. ($page - 3) .'</a></li>';  
                if($page - 2 > 0) $page2left = '<li class="page-item"><a class="page-link" href= ./?page='. ($page - 2) .'>'. ($page - 2) .'</a></li>';  
                if($page - 1 > 0) $page1left = '<li class="page-item"><a class="page-link" href= ./?page='. ($page - 1) .'>'. ($page - 1) .'</a></li>';  

                if($page + 5 <= $total) $page5right = '<li class="page-item"><a class="page-link" href= ./?page='. ($page + 5) .'>'. ($page + 5) .'</a></li>';  
                if($page + 4 <= $total) $page4right = '<li class="page-item"><a class="page-link" href= ./?page='. ($page + 4) .'>'. ($page + 4) .'</a></li>';
                if($page + 3 <= $total) $page3right = '<li class="page-item"><a class="page-link" href= ./?page='. ($page + 3) .'>'. ($page + 3) .'</a></li>';  
                if($page + 2 <= $total) $page2right = '<li class="page-item"><a class="page-link" href= ./?page='. ($page + 2) .'>'. ($page + 2) .'</a></li>';
                if($page + 1 <= $total) $page1right = '<li class="page-item"><a class="page-link" href= ./?page='. ($page + 1) .'>'. ($page + 1) .'</a></li>';  
            

                // Вывод меню  
                echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left.'<li class="page-item active"><a class="page-link"><b>'.$page.'</b></a></li>'.$page1right.$page2right.$nextpage;  

                ?>
                </ul>
            </nav>      
                
            </div><!-- .container-->
        
        </section>
    </div>
</div>
 <footer>
         <div class="container">
            <div class="col-md-6">    
                <p>* Ресурс подготовлен при поддержке РГНФ, проект 15-31-01263 "Картотека Н. К. Никольского".</p>
            </div> 
             <div class="col-md-6"> 
                 <span> Автор: Жуков Артем Евгеньевич; Программист: Гарага Анастасия Валерьевна.</span>
            </div>
        </div>
    </footer>
<script src="../bootstrap/js/tether.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
<script src="../bootstrap/js/mdb.js"></script>

</body>
</html>


