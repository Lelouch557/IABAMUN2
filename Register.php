<?php
if(isset($_COOKIE['Language'])){
    require_once('./Language/'.$_COOKIE['Language'].'/Global.php');
}else{
    require_once('./Language/ENG/Global.php');
}
include_once('Navigation.php');
?>
<!doctype html>
    <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="author" content="Andre Blok">
            <link rel="stylesheet" type="text/css" href="./CSS/Main.css">
            <title><?= Title ?> </title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        </head>
        <body>
            <div id="content">
                <form autocomplete="off" id="RegiForm" action="Register_Insert.php" method="POST">
                    <table>
                        <tr>
                            <td>
                                <input required autocomplete="off" type="text" id="RegiName" class="Input" placeholder="<?= User_Name ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input required autocomplete="off" type="password" id="RegiPass" class="Input" placeholder="<?= Password ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input required autocomplete="off" max='5' type="password" id="RegiPass2" class="Input" placeholder="<?= Password ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="Button" onclick='check()' class="Button" id="RegiBut" value="<?= Register ?>" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </body>
        <script>
            $(document).ready(function(){
                $('.Input').val('');
            });
            function check(){
                $pass1 = $('#RegiPass').val();
                $pass2 = $('#RegiPass2').val();
                $name = $('#RegiName').val();

                $.post('Register_Insert.php',{
                    Pass1:$pass1,
                    Pass2:$pass2,
                    Name:$name
                },function(data){
                    if(data==0){
                        alert('Only letters and numbers are permitted.');
                    }else{
                        alert('Something went wrong.';
                    }
                });
            }
        </script>
    </html>