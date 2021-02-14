<?php
require 'app/views/inc/header.php';
?>
  <h1>Shop will be there soon...</h1>
  <div id = "form-container" class="form">
<form id = "form" action="<?=ROOT.$_SERVER['REQUEST_URI'] ;?>" method="post" enctype="multipart/form-data">
<div  id="addGoods" >
 <input id="append" class="input" type="text" name="names[]">
 <select id="select" name="cath[]">
   <option value="books">Books</option>
   <option value="puzzles">Puzzles</option>
   <option value="boardGames">Board Games</option>
 </select>
 <input id = "photo" class="input" type="file" name="goodsPhoto" >
</div>
</form>
<div>
  <button id="addInput" class="button" type="button"> + </button>
</div>
<button id="submit"class="button" type="button"> Submit! </button>
</div>
  <div = "card-container">
    <div class="card">
      <strong> Goods </strong>
      <p>description</p>
    </div>
  </div>
  <?php
  var_dump($_POST);
  var_dump($_FILES);

  ?>
<script type="text/javascript">

$('document').ready( () => {
  $('#addInput').click( () => {
    let form = document.getElementById('form')
    let addGoods = document.getElementById('addGoods')
    let elem3 = addGoods.cloneNode(true)
     $('#form').append(elem3)
  } )
})
document.getElementById('form')
$('#submit').click( () => form.submit() )

</script>
<?php
require 'app/views/inc/footer.php';
?>
