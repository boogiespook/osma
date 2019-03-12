<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Example Info Buttons</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $(function() {
$(".dialog").dialog({
    autoOpen: false
});


$(".opener").click(function () {
    var id = $(this).data('id');
    $(id).dialog("open");
});
} );
  </script>
  
<style>

body {

    margin: 50px 50px;
    font-family: 'trebuchet MS', 'Lucida sans', Arial;
    font-size: 14px;
    color: #444;
}

img{
	border:0px;
	width: 20px;
	height: 20px;
	display: block;
}

</style>  
  
</head>
<body>
<table> 

<tr>
<td><div class="dialog" id="dialog1" title="Question 1">Detailed explanation of Question 1 </div></td>
<td>Question 1</td>
<td><button class="opener" data-id="#dialog1"><img src="images/info-button.png" alt=""></button></td>
</tr>


<tr>
<td><div class="dialog" id="dialog2" title="Question 2">Detailed explanation of Question 2 </div></td>
<td>Question 2</td>
<td><button class="opener" data-id="#dialog2"><img src="images/info-button.png" alt=""></button></td>
</tr>

</table> 
</body>
</html>