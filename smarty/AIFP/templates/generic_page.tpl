
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
                <script src="{$root}js/fixed_scrollable_bar.js"></script>
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
                                                    <li><a href="{$root}piante/schede_piante.php">Piante</a></li>
                                                    <li><a href="{$root}funghi/regolamento.php">Regolamenti</a></li>
                                                    <li><a href="{$root}prodotti/prodotti.php">Prodotti</a></li>
                                                    <li><a href="{$root}eventi/eventi.php">Eventi</a></li>
                                                    <li><a href="{$root}forum/forum.php">Forum</a></li>
                                                    <li><a href="{$root}lettera_esperto.php">Chiedi all'esperto</a></li>
							{if !$user}
                            	<li class="dropdown">
                                <a class="dropbtn "href="#"><img src="{$root}/images/user.png"></a>
                                <div class="dropdown-content">
                                    <a onclick="document.getElementById('login').style.display='block'" href="#">Accedi</a>
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
                        <div id="login" class="modal">
                            <form class="modal-content animate" method="post" action="{$root}login.php">
                            	 <div class="logcontainer" style="background-color: #f1f1f1">
                                	
                                	
                                	<label><b>ACCEDI AD AIFP</b></label>
                                </div>
                                <div class="imgcontainer">
                                	<span onclick="document.getElementById('login').style.display='none'" class="close" title="Chiudi">&times;</span>
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
                        
                        <!-- Allert form -->
                        <div id="alert" class="modal">
                            <div class="modal-content animate alert">
                                <span onclick="document.getElementById('alert').style.display='none'" class="alertclosebtn" title="Chiudi">&times;</span>
                                <strong>Attenzione!<strong> 
                            </div>
                        </div>
                                           
        {/block}
		</div>
		<!-- Header -->
                
		<!-- Body -->
            <body>
                <div id="main">
                     <div class="container">
                        <div id="banner"></div>
                    </div>

                    <div class="container">
                        <div class="row">
                            {block name=sidebar}
                            {/block}

                            {block name=main}
                            {/block}
                        </div>
                    </div>
                </div>
            </body>
		<!-- /Body -->
                
		<!-- buttom_main -->
		<div id="buttom_main">
		{block name=buttom_main}
              
                {/block}
		</div>
		<!--block body closed-->
    {/block}
	<!-- /Footer -->
	<div id="footer">
	{block name=footer}
		<div class="container">
	<!-- Copyright -->
">
                <div id="copyright">
                <div class="container">
                    Design: <a href="http://templated.co">TEMPLATED</a> Images: <a href="http://unsplash.com">Unsplash</a> (<a href="http://unsplash.com/cc0">CC0</a>)
                </div>
                </div>
            </div>
			
        </div>
		
	<!-- Copyright -->
	{/block}
	</div>
	<!-- Footer -->
	</body>
</html>