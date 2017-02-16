<!DOCTYPE HTML>
{assign	"root" "/AIFP/"}
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
                <script src="{$root}js/eventi.js"></script>
		<script src="{$root}js/slideshow.js"></script>
                <script src="{$root}js/personal_page.js"></script>
                <!--<script src="js/fixed_scrollable_bar.js"></script>-->
                <script src="{$root}js/reg.js"></script>
		{/block}
		{block name=css}
    	<link rel="stylesheet" href="{$root}css/skel-noscript.css" />
		<link rel="stylesheet" href="{$root}css/style.css" />
		<link rel="stylesheet" href="{$root}css/style-desktop.css" />
		{/block}
	{/block}
        
        
	</head>
        {block name="body"}
        <body onload="download()">
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
                                                    
                                                    <li><a href="{$root}eventi/eventi.php">Eventi</a></li>
                                                    <li><a href="{$root}forum/forum.php">Forum</a></li>
                                                    <li><a href="{$root}lettera_esperto.php">Chiedi all'esperto</a></li>
                                {if !$profilo.user}
                                    <li class="dropdown">
                                    <a class="dropbtn "href="#"><img src="{$root}/images/user.png"></a>
                                    <div class="dropdown-content">
                                        <a onclick="document.getElementById('login').style.display='block'" href="#">Accedi</a>
                                        <a href="{$root}profilize/reg.php">Registrati</a>
                                    </div>
                                    </li>
                           	{else}
                                    <li class="dropdown">   
                                                                              
                                        <a class="dropbtn "href="#">
                                             <img class="picnav" src={$root}{$profilo.image}> 
                                            <p> {$profilo.user}</p>
                                        </a>
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
                            <form name="login" class="modal-content animate" method="post" onsubmit="return testlogin()" action="{$root}login.php">
                            	 <div class="logcontainer" style="background-color: #f1f1f1">
                                	
                                	
                                	<label><b>ACCEDI AD AIFP</b></label>
                                </div>
                                <div class="imgcontainer">
                                	<span onclick="document.getElementById('login').style.display='none'" class="close" title="Chiudi">&times;</span>
                                    <img src="{$root}images/img_avatar.png" alt="Avatar" class="avatar">
                                </div>

                                <div class="logcontainer">
                                    <input id="mailus" type="text" placeholder="Inserisci Username" name="email" required>
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
                                    <button class="loginbtn" type="submit">Login</button>
                                    <br>
                                    
                                </div>
                                <div class="logcontainer" style="background-color:#f1f1f1">
                                	   <span>Non hai un account? <a href="{$root}profilize/reg.php">Iscriviti >></a>
                                    
                                </div>
                            </form>
                        </div>
                        
                                           
                        <!-- FUNNGO FORM -->
                           <div id="descr" class="modal">
                            <div class="modal-content fun animate">                
                                <div class="logcontainer" style="background-color: #f1f1f1">
                                    <label><b>{$descrizione.genere} {$descrizione.fungo}</b></label>
                                    <span onclick="document.getElementById('descr').style.display='none'" class="close" title="Chiudi">&times;</span>
                                </div>
                            
                            <div class="row half">
                                <div class="6u">
                                <section>
                                <div class="slideshow-container">
                                    {$max = count($foto)}
                                    {$count=0}
                                    {foreach $foto as $f}
                                        {if $count!=0}
                                            {$count=$count+1}
                                            <div class="mySlides fade">
                                                <div class="numbertext">{$count} / {$max}</div>
                                                <a class="image full"><img src="{$root}{$f}" alt=""></a>
                                            </div>
                                        {/if}
                                        {if $count==0}
                                            {$count=$count+1}
                                            <div class="mySlides fade" style="display: block;">
                                                <div class="numbertext">1 / {$max}</div>
                                                <a class="image full"><img src="{$root}{$f}" alt=""></a>
                                            </div>
                                        {/if}
                                        
                                    {/foreach}
                                    
                                    <a class="prev" onclick="plusSlides(-1)">❮</a>
                                    <a class="next" onclick="plusSlides(1)">❯</a>
                                </div>
                                <br>
                                
                                {$i=0}
                                
                                <div style="text-align:center">
                                    {while $i < $max}
                                         <span class="dot" onclick="currentSlide({$i})"></span> 
                                         {$i=$i+1}
                                    {/while}
                                </div>
                                </section>
                            </div>
                            <div class="4u">
                            <ul>
                                <li><b>Commestibile</b> {$descrizione.commestibile}</li>
                                <li><b>Sporata</b> {$descrizione.sporata}</li>
                                <li><b>Viraggio</b> {$descrizione.viraggio}</li>
                            </ul>
                            <hr>
                            </div>                                

                            <div class="4u">
                                <ul>
                                    <li><b>Imenio</b> {$descrizione.imenio}</li>
                                    <li><b>Anello</b> {$descrizione.anello}</li>
                                    <li><b>Volva</b> {$descrizione.volva}</li>
                                    <li><b>Habitat</b> {$descrizione.habitat}</li>
                                    <li><b>Stagione</b> {$descrizione.stagione}</li>
                                </ul>
                            </div>

                            <div class="11u">
                                <hr>
                                <ul>
                                    <li><b>Cappello</b> {$descrizione.cappello}</li>
                                    <li><b>Colore</b> {$descrizione.colore}</li>
                                    <li><b>Gambo</b> {$descrizione.gambo}</li>
                                    <li><b>Pianta</b> {$descrizione.pianta}</li>
                                    <li><b>Descrizione</b> {$descrizione.descrizione}</li>
                                </ul>         

                                </div>
                                </div>
                        </div>
                </div>
                        
                                       
                        <!-- Alert form -->
                        <div id="alert_login" class="modal">
                            <div class="modal-content animate alert">
                                <a href="{$root}index.php" id="link"></a>
                                <span onclick="document.getElementById('link').click();" class="alertclosebtn" title="Chiudi">&times;</span>
                                <strong>Attenzione!</strong> <a onclick="document.getElementById('login').style.display='block'; document.getElementById('alert_login').style.display='none'"><u>Accedi per continuare {$sessione}</u></a>
                            </div>
                        </div>
                        <div id="alert" class="modal">
                            


                            <div class="modal-content animate alert">
                                <span onclick="document.getElementById('alert').style.display='none'" class="alertclosebtn" title="Chiudi">&times;</span>
                                <strong>Attenzione!</strong> {$error}
                            </div>
                        </div>
                        
                        <!-- Success Form -->
                        <div id="success" class="modal">
                            <div class="modal-content animate alert success">
                                <span onclick="document.getElementById('success').style.display='none'" class="alertclosebtn" title="Chiudi">&times;</span>
                                <strong>Successo!</strong> {$message}
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
        {block name=footer}
	<div id="footer">
            <div id="copyright">
                <div class="container">
                    <div class="row half">
                        <div class="4u">
                            <h3>Chi siamo</h3>
                            <p>Web site that worry to join all togheter mycological associations, users and burocracy in all one web interface, in order to simplify the user life but in the same time the states can manage all the user and association with relative license to perform the mushrooms picking in the national territory.
</p>
                            <p>
                        </div>
                        <div class="4u">
                            <h3> Seguici sui social </h3>
                        <ul>
                            <li>Facebook</li>
                            <li>Twitter</li>
                            <li>Instagram</li>
                        </ul>
                            <h3> Contattaci </h3>
                            <ul>
                                <li>g.faggioni5@gmail.com</li>
                                <li>gianrmacotroiano@gmail.com</li>
                            </ul>
                        </div>
                        <div class="4u">
                            <h3>¢ Copyright</h3>
                            <p>Design: <a href="http://templated.co">TEMPLATED</a> Images: <a href="http://unsplash.com">Unsplash</a> (<a href="http://unsplash.com/cc0">CC0</a>)</p>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
	{/block}

	<!-- Footer -->
	</body>
</html>