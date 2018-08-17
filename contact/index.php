<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Картотека Н. К. Никольского</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap/css/compiled.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <!--  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>  -->
    <script type="text/javascript" src="/bootstrap/js/jquery.js"></script> 
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
                <li class="nav-item">
                    <a class="nav-link" href="/search">Поиск</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/contact">Обратная связь</a>
                </li>
            </ul>
        </div>
    </nav>

</header>
    <div class="fon">

        <section class="section">
            <div class="container">

                <div class="card form form-css">
                    <div class="card-block">
                        <form role="form" id="form_contact" class="feedback_form">
                
                            <div class="form-header brown darken-1">
                                <h3>Форма обратной связи:</h3>
                            </div>

                            <div class="md-form">
                                <i class="fa fa-user-circle prefix grey-text"></i>
                                <input type="text" name="name" id="form1" class="form-control" autofocus>
                                <label for="form1">Имя: </label>
                            </div>

                             <div class="md-form">
                                <i class="fa fa-envelope prefix grey-text"></i>
                                <input type="text" name="email" id="form2" class="form-control">
                                <label for="form2">E-mail: </label>
                            </div>

                            <div class="md-form">
                                <i class="fa fa-pencil prefix grey-text"></i>
                                <textarea name="text" type="text" id="form3" class="md-textarea" style="height: 100px"></textarea>
                                <label for="form3">Ваше сообщение: </label>
                            </div>

                            <div class="text-center">
                                <button class="btn brown darken-1 btn--submit" type="submit">Отправить</button> 
                            </div>
                        </form> 
                
                    </div>
                </div>

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
<script src="../js/doc.js"></script>
<script>
    document.querySelector('.feedback_form .btn--submit').addEventListener("click", function(e) {
        e.preventDefault();
        sendForm();
      });
      
      function sendForm() {
        var xhr = new XMLHttpRequest();
        var $form = document.querySelector('.feedback_form');
        var formData = new FormData($form);
        xhr.open('POST', '/sendform.php');
        xhr.onload = function () {
            if (xhr.status !== 200) {
                alert('Что-то пошло не так ' + xhr.status);
            }
            else if (xhr.status === 200) {
                alert('Ваше письмо доставлено! Автор ответет вам в ближайшее время.');
                $form.querySelectorAll(".feedback_form__field").forEach(function (elem) {
                    elem.value = "";
                });
                modalShow(false);
            }
        };

        var $error = [];
        $form.querySelectorAll(".modal__field").forEach(function (elem) {
            if (!elem.value) {
                $error.push(elem);
            }
        });

        if ($error.length) {
            $error.forEach(function (elem) {
                elem.classList.add("modal__field--error");
            });
            alert("Заполните обязательные поля");
        }
        else {
            xhr.send(formData);
        }

    }
</script>
</body>
</html>