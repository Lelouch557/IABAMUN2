<?PHP
$_SESSION=array('LOL'=>'LOL');
if(isset($_GET['L'])){
	REQUIRE_ONCE('./Language/'.$_GET['L'].'/Global.php');
}else{
	REQUIRE_ONCE('./Language/ENG/Global.php');
}?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<title><?PHP echo $_GLOBAL['IABAMUN']?></title>
	<script>
   	localStorage.setItem("Name", "Lelouch557");
	window.onload =
	function()	
	{
		names();
	};
	function names(){
		$('#indasput').val(localStorage.getItem("Name"));
		console.log(localStorage.getItem("Name"));
	}
</script>
	
</head>
<body>
	<table >
		<tr>
			<td>
				<?PHP
				echo $_GLOBAL['Login'];
				?>
			</td>
			<td>
				<input type="text" id="indasput"/>
			</td>
		</tr>
	</table>
	<div onload="names()" ></div>
	
</body>

</html>