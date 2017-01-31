
<!DOCTYPE HTML>
{assign "root" "/AIFP/"}
<html>
	<head>
	{block name=head}
		<title>{block name=title}Generic Page{/block}</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		{block name=js}
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="{$root}js/skel.min.js"></script>
		<script src="{$root}js/skel-panels.min.js"></script>
		<script src="{$root}js/init.js"></script>
		<script src="{$root}js/login.js"></script>
		<script src="{$root}js/slideshow.js"></script>
		{/block}
		{block name=css}
    	<link rel="stylesheet" href="{$root}css/skel-noscript.css" />
		<link rel="stylesheet" href="{$root}css/style.css" />
		<link rel="stylesheet" href="{$root}css/style-desktop.css" />
		{/block}
	{/block}
	</head>
	{block name=define_class}
	<body>
	{/block}
	{block name=general_body}
	<!-- Header -->		
		<div id="header">
            {block name=header}
			<div class="container">
					
				<!-- Logo -->
					<div id="logo">
						<h1><a href="{$root}index.php">AIFP</a></h1>
					</div>
			</div>
			<div id="nav-wrapper" class="container" >
			
				<!-- Nav -->
					<nav id="nav">
					{block name=menu}
						<ul>
							<li><a href="{$root}index.php">Home</a></li>
							<li class="dropdown">
                                <a class="dropbtn" href="{$root}funghi/funghi.php">Funghi</a>
                                <div class="dropdown-content">
                                    <a href="{$root}funghi/storia.php">Storia del fungo</a>
                                    <a href="{$root}funghi/schede_funghi.php">Schede funghi</a>
                                    <a href="{$root}prodotti/libri.php">Libri e guide</a>
                                </div>
                            </li>            
							<li><a href="{$root}funghi/regolamento.php">Regolamenti</a></li>
							<li><a href="{$root}eventi/eventi.php">Eventi</a></li>
							<li><a href="{$root}forum/forum.php">Forum</a></li>
							<li><a href="{$root}lettera_esperto.php">Chiedi all'esperto</a></li>
							{if !$user}
                            	<li class="dropdown">
                                <a class="dropbtn "href="#"><img src="{$root}css/images/user.png"></a>
                                <div class="dropdown-content">
                                    <a onclick="document.getElementById('id01').style.display='block'" href="#">Accedi</a>
                                    <a href="{$root}profilize/reg.php">Registrati</a>
                                </div>
                           		</li>
                           	{else}
                           		<li class="dropdown">                           			
                           			 <a class="dropbtn "href="#"><img src={$image}><p>Benvenuto {$user}</p></a>
	                           		<div class="dropdown-content">
	                                    <a  href="{$root}personal_page/personal_page.php">Pagina personale</a>
	                                    <a href="{$root}logout.php">logout</a>                                
	                                </div>                           				
                           		</li>
                           	{/if}

						</ul>
                    {/block}             
					</nav> 
			</div>
			
            <!-- Login form -->
                        <div id="id01" class="modal">
                            <form class="modal-content animate" method="post" action="{$root}login.php">
                            	 <div class="logcontainer" style="background-color: #f1f1f1">
                                	
                                	
                                	<label><b>ACCEDI AD AIFP</b></label>
                                </div>
                                <div class="imgcontainer">
                                	<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Chiudi">&times;</span>
                                    <img src="{$root}images/img_avatar.png" alt="Avatar" class="avatar">
                                </div>

                                <div class="logcontainer">
                                	<input type="text" placeholder="Inserisci Username" name="email" required>
                                    <br>
                                    <input type="password" placeholder="Inserisci Password" name="password" required>
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
                                	   <span>Non hai un account? <a href="{$root}profilize/reg.php">Iscriviti >></a>
                                    
                                </div>
                            </form>
                        </div>
        {/block}
		</div>
		<!-- Header -->

		<!-- Body -->
			<body>
                        
                                             
                            {if $sb=='true'}
                                {block name=sidebar}
                                    <div id="main">
                                        <div class="container">
                                            <div id="banner"></div>
                                        </div>
			
                                        <div class="container">
                                            <div class="row">
                                                <div id="sidebar" class="3u">
                                                <section>
                                                <header>
                                                        <h2></h2>
                                                </header>
                                                <p>Questa left-sidebar la possiamo sfruttare in qualche modo?? dal punto di vista estetico non dispiace.</p>
                                                <ul class="style1">
                                                        <li><a href="#">Vestibulum luctus venenatis dui</a></li>
                                                        <li><a href="#">Integer rutrum nisl in mi</a></li>
                                                        <li><a href="#">Etiam malesuada rutrum enim</a></li>
                                                        <li><a href="#">Aenean elementum facilisis ligula</a></li>
                                                        <li><a href="#">Ut tincidunt elit vitae augue</a></li>
                                                        <li><a href="#">Sed quis odio sagittis leo vehicula</a></li>
                                                </ul>
                                                </section>
                                                <section>
                                                <header>
                                                        <h2>Sagittis convallis</h2>
                                                </header>
                                                <p>Quisque dictum. Integer nisl risus, sagittis convallis elementum.</p>
                                                <ul class="style1">
                                                        <li><a href="#">Vestibulum luctus venenatis dui</a></li>
                                                        <li><a href="#">Integer rutrum nisl in mi</a></li>
                                                        <li><a href="#">Etiam malesuada rutrum enim</a></li>
                                                        <li><a href="#">Aenean elementum facilisis ligula</a></li>
                                                        <li><a href="#">Ut tincidunt elit vitae augue</a></li>
                                                        <li><a href="#">Sed quis odio sagittis leo vehicula</a></li>
                                                </ul>
                                                </section>
                                                </div>
                                        {/block}
                                                {block name=main}

                                                {/block}
                                            </div>
                                        </div>
                                    </div>
                            {else}
                            {block name=main}

                            {/block}
                            {/if}
						</body>
		<!-- /Body -->
                
		<!-- buttom_main -->
		<div id="buttom_main">
		{block name=buttom_main}
			<div class="container">
				<div class="row half">
					<div class="3u">
						<section>
							<header>
								<h2>EVENTI & SAGRE</h2>
							</header>
							<ul class="default">
								<li><img src="{$root}images/pics04.jpg" width="78" height="78" alt="">
									<p>Nullam non wisi a sem eleifend. Donec mattis libero.</p>
									<span class="posted">May 9th  |  (10 )  Comments</span>
								</li>
								<li><img src="{$root}images/pics05.jpg" width="78" height="78" alt="">
									<p>Nullam non wisi a sem eleifend. Donec mattis libero.</p>
									<span class="posted">May 1st  |  (10 )  Comments</span>
								</li>
								<li><img src="{$root}images/pics06.jpg" width="78" height="78" alt="">
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
								<li><img src="{$root}images/pics07.jpg" width="78" height="78" alt="">
									<p>Nullam non wisi a sem eleifend. Donec mattis libero.</p>
									<span class="posted">May 9th  |  (10 )  Comments</span>
								</li>
								<li><img src="{$root}images/pics08.jpg" width="78" height="78" alt="">
									<p>Nullam non wisi a sem eleifend. Donec mattis libero.</p>
									<span class="posted">May 1st  |  (10 )  Comments</span>
								</li>
								<li><img src="{$root}images/pics09.jpg" width="78" height="78" alt="">
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
									<a href="#" class="image full"><img src="{$root}images/pics10.jpg" alt=""></a>
									<p><b>TITOLO 1</b>
										sottotitolo</P>

								</div>
								<div class="mySlides fade">
									<div class="numbertext">2 / 3</div>
									<a href="#" class="image full"><img src="{$root}images/pics10_1.jpg" alt=""></a>
									<p><b>TITOLO 2</b>
										sottotitolo</P>

								</div>
								<div class="mySlides fade">
									<div class="numbertext">3 / 3</div>
									<a href="#" class="image full"><img src="{$root}images/pics10_2.jpg" alt=""></a>
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
			<!--block buttom_main closed-->
        {/block}
		</div>
		<!--block body closed-->
    {/block}
	<!-- /Footer -->
	<div id="footer">
	{block name=footer}
		<div class="container">
	<!-- Copyright -->
			<div id="copyright">
				<div class="container">
					Design: <a href="http://templated.co">TEMPLATED</a> Images: <a href="http://unsplash.com">Unsplash</a> (<a href="http://unsplash.com/cc0">CC0</a>)
				</div>
			</div>
		</div>
	<!-- Copyright -->
	{/block}
	</div>
	<!-- Footer -->
	</body>
</html>