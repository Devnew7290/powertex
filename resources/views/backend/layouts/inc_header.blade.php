<?php
	if(empty($_title)) 			$_title ='Uretek';
	if(empty($_keywords)) 		$_keywords ='';
	if(empty($_description)) 	$_description ='';
?>
<title>
    <?php echo $_title;?>
</title>
<meta name="keywords" content="<?php echo $_keywords;?>" />
<meta name="description" content="<?php echo $_description;?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="robot" content="index, follow" />
<meta name='copyright' content='Orange Technology Solution co.,ltd.'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
<link type="text/css" rel="stylesheet" href="{{asset('css/layout.css')}}" />
<link type="image/ico" rel="shortcut icon" href="{{asset('images/favicon.ico')}}">
<link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">


<!--Owl Carousel-->
<link rel="stylesheet" href="{{asset('owlcarousel/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('owlcarousel/css/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{asset('css/aos.css')}}">








<!--JS-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"
    integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous">
</script>
<!-- <script src="js/jquery.min.js"></script> -->
<!-- <script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script> -->
<script src="{{asset('js/jquery-ui.js')}}"></script>
<script src="{{asset('js/modernizr.js')}}"></script>
<script src="{{asset('js/aos.js')}}"></script>
<script src="{{asset('owlcarousel/js/owl.carousel.min.js')}}"></script>

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>