<?
require "../php/database/conexao.php";
?>
<!DOCTYPE HTML>
<html> 
    <head>
        <title>PIN - ADM</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/png" href="img/logo.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="" />
        <meta name="keywords" content=""/>
        <meta name="robots" content="index, follow">
        <link rel="stylesheet" type="text/css" href="../css/adm/pin.css" media="(min-width: 1000px)">
        <link rel="stylesheet" type="text/css" href="../css/geral/geral.css" media="(min-width: 1000px)">
        <!-- <link rel="stylesheet" type="text/css" href="cssmobile/index.css" media="(max-width: 999px)"> -->
        <!-- <link rel="stylesheet" type="text/css" href="cssmobile/geral/geral.css" media="(max-width: 999px)"> -->
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    
    <body>
        
		<div id="pin">
            <h1>PIN de acesso</h1>

            <div id="codigo">
                <div class="input linha" id="pin_1"><input type="number" value="" step="1" maxlength="1" max="9" min="0" size="1" autofocus="" placeholder="*"></div>
                <div class="input linha" id="pin_2"><input type="number" value="" step="1" maxlength="1" max="9" min="0" size="1" placeholder="*"></div>
                <div class="input linha" id="pin_3"><input type="number" value="" step="1" maxlength="1" max="9" min="0" size="1" placeholder="*"></div>
                <div class="input linha" id="pin_4"><input type="number" value="" step="1" maxlength="1" max="9" min="0" size="1" placeholder="*"></div>
            </div>
    	</div>

    </body>

    <script type="text/javascript">  
    </script>
    <script src="js/index.js?<? echo time(); ?>"></script>
</html>