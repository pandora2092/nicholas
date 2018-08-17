<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Картотека Н. К. Никольского</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">s
    <link rel="stylesheet" href="../bootstrap/css/compiled.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  <script src="/bootstrap/js/compiled.min.js"></script> -->
    <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>  -->
    <script type="text/javascript" src="../bootstrap/js/jquery.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>    
    <script>
        $(document).ready(function(){
            $("#search-prof").submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "script.php",
                    type: "post",
                    data: $("#search-prof").serialize(),
                    success: function(search_result) {
                        $("#answer").html(search_result);
                    }

                });
            });

            $("#search-simple").submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "script-simple.php",
                    type: "post",
                    data: $("#search-simple").serialize(),
                    success: function(search_result) {
                        $("#answer").html(search_result);
                    }

                });
            });
        });
    </script>
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
        </div>
    </nav>

</header>
    <div class="fon">

        <section class="section">
        <div class="container">
            <div class="tabs">

              <ul class="tabs__caption tabs_custom">
                <li class="active"><a href="#search"></a>Поиск</li>
                <li><a href="#profsearch"></a>Расширенный поиск</li>
              </ul>

              <div class="tabs__content active">
                 <div class="card form">
                    <div class="card-block wrap_forms">
                        <form name="search-simple" id="search-simple" method="post" action="">
                       
                            <div class="form-header  brown darken-1">
                                <h3></i> Введите запрос для поиска:</h3>
                            </div>

                            <div class="md-form">
                                <input type="search" name="query" id="form0" class="form-control">
                                <label for="form0">Поисковый запрос</label>
                            </div>

                            <div class="text-center">
                                <button class="btn brown darken-1" type="submit">Найти</button>                             
                            </div>
                        </form>
                    </div>
                </div>
              </div>

              <div class="tabs__content">
                 <div class="card form">
                    <div class="card-block wrap_forms">
                        <form name="search-prof" id="search-prof" method="post" action="">
                    
                            <div class="form-header brown darken-1">
                                <h3> Введите запрос для расширенного поиска:</h3>
                            </div>

                            <div class="md-form">
                                <input type="text" name="name" id="form1" class="form-control">
                                <label for="form1">Название произведения</label>
                            </div>

                             <div class="md-form">
                                <input type="text" name="code" id="form2" class="form-control">
                                <label for="form2">Шифр</label>
                            </div>

                            <div class="md-form">
                                <input type="text" name="manuscript" id="form3" class="form-control">
                                <label for="form3">Общие сведения</label>
                            </div>

                            <div class="md-form">
                                <input type="text" name="info" id="form4" class="form-control">
                                <label for="form4">Заглавие</label>
                            </div>

                            <div class="md-form">
                                <input type="text" name="bibliography" id="form5" class="form-control">
                                <label for="form5">Библиография</label>
                            </div>

                            <div class="text-center">
                                <button class="btn brown darken-1" type="submit">Найти</button> 
                            </div>
                        </form>
                    </div>
                </div>
              </div>

            </div><!-- .tabs-->
            <form action="../fulltable/" method="post" class="form_full">
                <input type="hidden" value="25" name="num">
                <button class="btn brown darken-1 btn_post" type="submit">Показать все</button> 
            </form>
        </div><!-- .container-->
        
        </section>


        <div class="section table_result">
            <div class="container">
                <div id="answer"></div> <!--Контейнер для вывода информации, полученной от запроса к базе данных-->
        </div>
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

<script>
(function($) {
$(function() {

    function createCookie(name,value,days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";
        document.cookie = name+"="+value+expires+"; path=/";
    }
    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }
    function eraseCookie(name) {
        createCookie(name,"",-1);
    }

    $('ul.tabs__caption').each(function(i) {
        var cookie = readCookie('tabCookie' + i);
        if (cookie) {
            $(this).find('li').removeClass('active').eq(cookie).addClass('active')
                .closest('div.tabs').find('div.tabs__content').removeClass('active').eq(cookie).addClass('active');
        }
    });

    $('ul.tabs__caption').on('click', 'li:not(.active)', function() {
        $(this)
            .addClass('active').siblings().removeClass('active')
            .closest('div.tabs').find('div.tabs__content').removeClass('active').eq($(this).index()).addClass('active');
        var ulIndex = $('ul.tabs__caption').index($(this).parents('ul.tabs__caption'));
        eraseCookie('tabCookie' + ulIndex);
        createCookie('tabCookie' + ulIndex, $(this).index(), 365);
    });

});
})(jQuery);
</script>

</body>
</html>