<div>
    <h1><?=$this->title?></h1>
    <div class="container2">
  <form name="loginform" id="login" class="login"  method="post">
    <label for="login"> Login </label>
    <input type="text" name="login" >
    <label for="login"> Password </label>
    <input type="password" name="password" >
    <div class="buttons">

      <a href="<?=\ROOT."/main/registration" ?>" class="button"> Registration </a>
      <input id="submit" class="button" type="submit"  value="Login">
    </div>
      <div id="alert" class="alert none">  </div>
  </form>
<script>

    document.addEventListener('DOMContentLoaded', () => {
        $('#submit').click(function (e) {
            e.preventDefault();
            console.log('aaaa');
            let login = $('input[name="login"]').val()
            let password = $('input[name="password"]').val()

            $.ajax({
                url : "/Main",
                type: "POST",
                dataType: "text",
                data: {
                    login : login,
                    password : password
                },
                success: function(data) {
                    $('#alert').removeClass('none').text(data)
                }
            })
        })
    });


</script>
</div>
  </form>
</div>
