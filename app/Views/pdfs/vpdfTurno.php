<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
       
        @font-face {
            font-family: 'ProximaNova'; 
            src: url(FCPATH .'assets/fonts/custom/proxima-nova.otf') format('opentype');
           
        }

        .container{
            /* border:3px solid red; */
            margin: 0;
            padding: 0;
            left:0%;
            top:0;
            position: absolute;
            width:100%;
            height: 100%;
            background-image: url('<?= $dataImagen ?>');
            background-size:100% 100%;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .proxima{
            font-family: 'ProximaNova', sans-serif;
        }
        .folio{
            width:10%;
            color:#ecf7ff;
            font-weight: bold;
            /* border:1px solid red; */
        }
    </style>
<body>
    <div class='container'>
        <div class="folio" style="margin-left: 74%; margin-top:9.7%;">
            <span class="proxima "><?php echo $dataPage; ?></span>
        </div>
    </div>
</body>
</html>