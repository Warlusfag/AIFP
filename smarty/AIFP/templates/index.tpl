<!DOCTYPE HTML>

<html>
	<head>
		<title>AIFP</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<script src="js/login.js"></script>
		<script src="js/slideshow.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
	</head>
	<body class="homepage">

	<!-- Header -->
		<div id="header">
			<div class="container">
					
				<!-- Logo -->
					<div id="logo">
						<h1><a href="index.php">AIFP</a></h1>
					</div>
			</div>
			<div id="nav-wrapper" class="container" >
				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li class="dropdown">
                                                            <a class="dropbtn" href="funghi/funghi.php">Funghi</a>
                                                                <div class="dropdown-content">
                                                                    <a href="funghi/storia.php">Storia del fungo</a>
                                                                    <a href="funghi/schede_funghi.php">Schede funghi</a>
                                                                    <a href="prodotti/libri.php">Libri e guide</a>
                                                                </div>
                                                        </li>            
							<li><a href="funghi/regolamento.php">Regolamenti</a></li>
							<li><a href="eventi/eventi.php">Eventi</a></li>
							<li><a href="forum/forum.php">Forum</a></li>
							<li><a href="lettera_esperto.php">Chiedi all'esperto</a></li>
                            {if !$user}
                            	<li class="dropdown">
                                <a class="dropbtn "href="#"><img src="css/images/user.png"></a>
                                <div class="dropdown-content">
                                    <a onclick="document.getElementById('id01').style.display='block'" href="#">Accedi</a>
                                    <a href="profilize/reg.php">Registrati</a>
                                </div>
                           		</li>
                           	{else}
                           		<li><a href="#"><img src="css/images/user.png"><p> Ciao {$user}</p></a></li>
                           	{/if}
						</ul>
            				                               
					</nav> 
			</div>
			<div class="container">
                            <div id="banner"><a href="index.php" class="image featured"><img src="images/pics11_2.jpg" alt=""></a></div>
            </div>
            <!-- Login form -->
                        <div id="id01" class="modal">
                            <form class="modal-content animate" method="post" action="login.php">
                            	 <div class="logcontainer" style="background-color: #f1f1f1">
                                	
                                	
                                	<label><b>ACCEDI AD AIFP</b></label>
                                </div>
                                <div class="imgcontainer">
                                	<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Chiudi">&times;</span>
                                    <img src="images/img_avatar.png" alt="Avatar" class="avatar">
                                </div>

                                <div class="logcontainer">
                                	<input type="text" placeholder="Inserisci Username" name="email" required>
                                    <br>
                                    <input type="password" placeholder="Inserisci Password" name="password" required>
                                    <br>
                                    <label>Accedi come: </label>
                                    <br>
                                    <input formmethod="get" type="radio" name="type" value="utente">Utente
                                    <input formmethod="get" type="radio" name="type" value="iscritto">Iscritto
                                    <input formmethod="get" type="radio" name="type" value="micologo">Micologo
                                    <input formmethod="get" type="radio" name="type" value="botanico">Botanico
                                    <input formmethod="get" type="radio" name="type" value="associazione">Associazione
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
            <!-- /Login form -->
		</div>
	<!-- Header -->
		

	<!-- Main -->
		<div id="main">
			
			<div class="container">
				<section>
					<header>
						<h4>Scopri il fantastico mondo dei funghi!!</h4>
					</header>
					<div class="row">
						<div class="4u">
							<section>
								<a href="funghi/funghi.php" class="image full"><img src="images/pics01.jpg" alt=""></a>
								<p>Entra nel fantastico mondo dei funghi. Scopri la loro storia e tutte le loro caratteristiche grazie alla nostra sezione dedicata al FUNGO</p>
								<a href="funghi/funghi.php" class="button">Entra</a>
							</section>
						</div>
						<div class="4u">
							<section>
								<a href="#" class="image full"><img src="images/pics02.jpg" alt=""></a> 
								<p>Consulta il nostro FORUM in cui potresti chiarire ogni dubbio sul mondo micologico. Non dimenticarti di effettuare l'accesso! </p>
								<a href="#" class="button">FORUM</a>
							</section>
						</div>
						<div class="4u">
							<section>
								<a href="#" class="image full"><img src="images/pics03.jpg" alt=""></a>
								<p>CHIEDI ALL'ESPERTO è il modo più semplice per rivolgere domande dirette ai nostri micologi professionisti pronti ad aiutarti!</p>
								<a href="#" class="button">CHIEDI ALL'ESPERTO</a>
							</section>
						</div>
					</div>
				</section>
			</div>
		</div>
	<!-- /Main -->

	<!-- Footer -->
		<div id="footer">
			<div class="container">
				<div class="row half">
					<div class="3u">
						<section>
							<header>
								<h2>EVENTI & SAGRE</h2>
							</header>
							<ul class="default">
								<li><img src="images/pics04.jpg" width="78" height="78" alt="">
									<p>Nullam non wisi a sem eleifend. Donec mattis libero.</p>
									<span class="posted">May 9th  |  (10 )  Comments</span>
								</li>
								<li><img src="images/pics05.jpg" width="78" height="78" alt="">
									<p>Nullam non wisi a sem eleifend. Donec mattis libero.</p>
									<span class="posted">May 1st  |  (10 )  Comments</span>
								</li>
								<li><img src="images/pics06.jpg" width="78" height="78" alt="">
									<p>Nullam non wisi a sem eleifend. Donec mattis libero.</p>
									<span class="posted">April 28th  |  (10 )  Comments</span>
								</li>
							</ul>
						</section>
					</div>
					<div class="3u">
						<section>
							<header>
								<h2>CORSI</h2>
							</header>
							<ul class="default">
								<li><img src="images/pics07.jpg" width="78" height="78" alt="">
									<p>Nullam non wisi a sem eleifend. Donec mattis libero.</p>
									<span class="posted">May 9th  |  (10 )  Comments</span>
								</li>
								<li><img src="images/pics08.jpg" width="78" height="78" alt="">
									<p>Nullam non wisi a sem eleifend. Donec mattis libero.</p>
									<span class="posted">May 1st  |  (10 )  Comments</span>
								</li>
								<li><img src="images/pics09.jpg" width="78" height="78" alt="">
									<p>Nullam non wisi a sem eleifend. Donec mattis libero.</p>
									<span class="posted">April 28th  |  (10 )  Comments</span>
								</li>
							</ul>
						</section>
					</div>
					<div class="6u">
						<section>
							<header>
								<h2>NEWS</h2>
							</header>
							<div class="slideshow-container"> 
								<div class="mySlides fade" style="display: block;">
									<div class="numbertext">1 / 3</div>
									<a href="#" class="image full"><img src="images/pics10.jpg" alt=""></a>
									<p><b>TITOLO 1</b>
										sottotitolo</P>

								</div>
								<div class="mySlides fade">
									<div class="numbertext">2 / 3</div>
									<a href="#" class="image full"><img src="images/pics10_1.jpg" alt=""></a>
									<p><b>TITOLO 2</b>
										sottotitolo</P>

								</div>
								<div class="mySlides fade">
									<div class="numbertext">3 / 3</div>
									<a href="#" class="image full"><img src="images/pics10_2.jpg" alt=""></a>
									<p><b>TITOLO 3</b>
										sottotitolo</P>

								</div>
								<a class="prev" onclick="plusSlides(-1)">❮</a>
								<a class="next" onclick="plusSlides(1)">❯</a>
							</div>
							<br>

							<div style="text-align:center">
							  <span class="dot" onclick="currentSlide(1)"></span> 
							  <span class="dot" onclick="currentSlide(2)"></span> 
							  <span class="dot" onclick="currentSlide(3)"></span> 
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	<!-- /Footer -->

	<!-- Copyright -->
		<div id="copyright">
			<div class="container">
				Design: <a href="http://templated.co">TEMPLATED</a> Images: <a href="http://unsplash.com">Unsplash</a> (<a href="http://unsplash.com/cc0">CC0</a>)
			</div>
		</div>


	</body>
</html>
