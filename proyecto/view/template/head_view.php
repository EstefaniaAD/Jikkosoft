<html>

<head>
    <meta charset="UTF-8">
    <title>Proyecto</title>
 <!--   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/5cd2074b5d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/5cd2074b5d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="resources/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="resources/js/javascript.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/locales/bootstrap-datepicker.es.min.js"></script>

-->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

<script src="https://kit.fontawesome.com/5cd2074b5d.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="resources/css/style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/locales/bootstrap-datepicker.es.min.js"></script>

<script src="resources/js/javascript.js"></script>
<script>
$(function() {
  $('#fecha').datepicker({
    format: 'yyyy/mm/dd',
    language: 'es',
    autoclose: true,
    todayHighlight: true
  });
});
$(function() {
  $('#fechaEdit').datepicker({
    format: 'yyyy/mm/dd',
    language: 'es',
    autoclose: true,
    todayHighlight: true
  });
});
  </script>
</head>

<header id="main-header" class="py-3 cabecero text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1> <i class="fa-solid fa-book-atlas"></i> Bibliotecas</h1>
            </div>
        </div>
    </div>
</header>