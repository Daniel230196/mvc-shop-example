<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <title> JSC </title>
  </head>
<header>
<div class = "container">
  <div class = "item" id = "main">  Just Some Content  </div>
<div class = "nav">
  <div id = "menu" class = "item1"> Menu
    <ul class="submenu"> <li> Content </li>
      <li> content </li></ul>
  </div>
  <div class = "item1" id ="shop"> Shop </div>
  <div class = "item1" id ="about"> About </div>
  <div class = "item1" id ="login"> Login </div>
</div>
</div>
<script type="text/javascript">

  document.getElementById('about').addEventListener('click', () => window.location.href = 'http://learn.loc/main/about')
  document.getElementById('shop').addEventListener('click', () => window.location.href = 'http://learn.loc/shop')
  document.getElementById('main').addEventListener('click', () => window.location.href = 'http://learn.loc/main')
  document.getElementById('login').addEventListener('click', () => window.location.href = 'http://learn.loc/main/login')
  $("#menu").on('click', () => $(".submenu").css('display','block' ) )
</script>
</header>
<body>
