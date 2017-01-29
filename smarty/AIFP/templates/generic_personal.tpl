<!DOCTYPE HTML>

<html>
	<head>
		<title>Generic Page</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="../js/skel.min.js"></script>
		<script src="../js/skel-panels.min.js"></script>
		<script src="../js/init.js"></script>
		<script src="../js/login.js"></script>
		<script src="../js/slideshow.js"></script>
    	<link rel="stylesheet" href="../css/skel-noscript.css" />
		<link rel="stylesheet" href="../css/style.css" />
		<link rel="stylesheet" href="../css/style-desktop.css" />
	</head>
	<body>

	<!-- Header -->
		<div id="header">
			<div class="container">
					
				<!-- Logo -->
					<div id="logo">
						<h1><a href="../index.php">AIFP</a></h1>
					</div>
			</div>
			<div id="nav-wrapper" class="container" >
				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="../index.php">Home</a></li>
							<li class="dropdown">
                                                            <a class="dropbtn" href="../funghi/funghi.php">Funghi</a>
                                                                <div class="dropdown-content">
                                                                    <a href="../funghi/storia.php">Storia del fungo</a>
                                                                    <a href="../funghi/schede_funghi.php">Schede funghi</a>
                                                                    <a href="../prodotti/libri.php">Libri e guide</a>
                                                                </div>
                                                        </li>            
							<li><a href="funghi/regolamento.php">Regolamenti</a></li>
							<li><a href="#">Eventi</a></li>
							<li><a href="#">Forum</a></li>
							<li><a href="#">Chiedi all'esperto</a></li>
							{if $user==null}
                            	<li class="dropdown">
                                <a class="dropbtn "href="#"><img src="../css/images/user.png"></a>
                                <div class="dropdown-content">
                                    <a onclick="document.getElementById('id01').style.display='block'" href="#">Accedi</a>
                                    <a href="#">Registrati</a>
                                </div>
                           		</li>
                           	{else}
                           		<li><a href="#"><img src="../css/images/user.png"><p>Ciao {$user}</p></a></li>
                           	{/if}

						</ul>
                                            
					</nav> 
			</div>
			
            <!-- Login form -->
                        <div id="id01" class="modal">
                            <form class="modal-content animate" method="post" action="login.php">
                            	 <div class="logcontainer" style="background-color: #f1f1f1">
                                	
                                	
                                	<label><b>ACCEDI AD AIFP</b></label>
                                </div>
                                <div class="imgcontainer">
                                	<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Chiudi">&times;</span>
                                    <img src="../images/img_avatar.png" alt="Avatar" class="avatar">
                                </div>

                                <div class="logcontainer">
                                	<input type="text" placeholder="Inserisci Username" name="uname" required>
                                    <br>
                                    <input type="password" placeholder="Inserisci Password" name="psw" required>
                                    <br>
                                    <label>Accedi come: </label>
                                    <br>
                                    <input type="radio" name="type" value="utente">Utente
                                    <input type="radio" name="type" value="iscritto">Iscritto
                                    <input type="radio" name="type" value="micologo">Micologo
                                    <input type="radio" name="type" value="botanico">Botanico
                                    <input type="radio" name="type" value="associazione">Associazione
                                    <br>
                                    <label class="rmbme"><input type="checkbox" checked="checked">Ricordami</label> 
                                    <span class="psw"><a href="#">Password</a> dimenticata?</span>
                                    <button class="loginbtn" type="submit">Login</button>
                                    <br>
                                    
                                </div>
                                <div class="logcontainer" style="background-color:#f1f1f1">
                                	   <span>Non hai un account? <a href="#">Iscriviti >></a>
                                    
                                </div>
                            </form>
                        </div>
                     
		</div>
		<!-- Header -->

		<!-- Body -->
			<body>
			{block name=main}

			{/block}
			</body>
		<!-- /Body -->

		
	<!-- Copyright -->
		<div id="copyright">
			<div class="container">
				Design: <a href="http://templated.co">TEMPLATED</a> Images: <a href="http://unsplash.com">Unsplash</a> (<a href="http://unsplash.com/cc0">CC0</a>)
			</div>
		</div>

	</body>
</html>