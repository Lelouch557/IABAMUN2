<?php
if(isset($_GET['L'])){
  REQUIRE_ONCE('./Language/'.$_GET['L'].'/Global.php');
}else{
  REQUIRE_ONCE('./Language/ENG/Global.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<title><?PHP echo 'IABAMUN'?></title>
	<link  rel="stylesheet" type="text/css" href="./CSS/Login.css">
</head>
<body>
	<div id="LoginDiv">
		<div id="LoginWrap">
 			<form id='FORM' autocomplete="off" action="Inlog.php" method="POST">
   			 	<table>
    		  		<tr>
    		    		<td>
    		      			<input name='User_Name' onfocus='' required autocomplete='off' type="text" placeholder='<?PHP echo 'User_Name'  ?>' id="User_Name"/>
    		    		</td>
    		  		</tr>
    		  		<tr>
    		    		<td>
    		      			<input name='Password' onfocus='' required autocomplete='off' type="password" placeholder='<?PHP echo 'Password'  ?>' id="Password"/>
    		    		</td>
    		  		</tr>
    		  		<tr>
    		    		<td colspan='2'>
    		      			<button id='butto' type="button" onclick='Inlog()' ><?PHP echo 'Login' ?></button>
    		    		</td>
    		  		</tr>
    			</table>
  			</form>
		</div>
	</div>
</body>
<script>
		$SavedName = '';
		Messages = [];
		Messages[1] = '<?=  'InlogValidationMessage1' ?>';
		Messages['User_Name'] = '<?=  'User_Name' ?>';
		Messages['Password'] = '<?=  'Password' ?>';
		function Inlog(){
			$USR_N = $('#User_Name').val();
			$Pass = $('#Password').val();
			if(!$USR_N || !$Pass){
				if(!$USR_N){
					$('#User_Name').attr('class','invalid');
					$('#User_Name').attr('placeholder',Messages[1]);
					$('#User_Name').attr('onfocus','Revert("User_Name")');
					
				}
				if(!$Pass){
					$('#Password').attr('class','invalid');
					$('#Password').attr('placeholder',Messages[1]);
					$('#Password').attr('onfocus','Revert("Password")');
				}
			}else{
				$.post('Check_Acc.php',{name:$USR_N,pass:$Pass},function(data){
					if(data==='0'){
						alert(data);
						$('#FORM').submit();
					}else{
						if(data==='1'){
							alert('<?=  'InlogValidationMessage3' ?>');
						}else{
							alert('<?=  'InlogValidationMessage4' ?>');
						}
					}
				});
			}
		}
		function Revert(data){
			id = '#'+data;
			$(id).attr('onfocus','');
			$(id).attr('class','no');
			if(id=='#User_Name'){$(id).val($SavedName);}
			$(id).attr('placeholder',Messages[data]);
		}
  	</script>
</html>
