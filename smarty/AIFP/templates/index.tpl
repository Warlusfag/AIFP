    
{extends file="generic_page_news.tpl"}

	{block "title"}AIFP{/block}

	{block name=define_class}
		<body class="homepage">
	{/block}

	{block name=main}
            {if $login == 1}
                <script>
                    document.getElementById('alert_login').style.display='block';
                </script>
            {/if}
            {if $message != null}
                <script>
                    document.getElementById('success').style.display='block';
                </script>
            {/if}
            {if $error != null}
                <script>
                    document.getElementById('alert').style.display='block';
                </script>
            {/if}
            <div id="index">
			<!--central image-->
			<div class="container">
                            <div id="banner"><a href="{$root}index.php" class="image featured"><img src="{$root}images/pics11_2.jpg" alt=""></a></div>
                        </div>
			<div class="container">
                            <section>
					<header>
                                            <br><h4>Scopri il fantastico mondo dei funghi!!</h4>
					</header>
					<div class="row">
						<div class="4u">
							<section>
								<a href="{$root}funghi/funghi.php" class="image full"><img src="{$root}images/pics01.jpg" alt=""></a>
								<p>Entra nel fantastico mondo dei funghi. Scopri la loro storia e tutte le loro caratteristiche grazie alla nostra sezione dedicata al FUNGO</p>
								<a href="{$root}funghi/funghi.php" class="button">Entra</a>
							</section>
						</div>
						<div class="4u">
							<section>
								<a href="{$root}forum/forum.php" class="image full"><img src="{$root}images/pics02.jpg" alt=""></a> 
								<p>Consulta il nostro FORUM in cui potresti chiarire ogni dubbio sul mondo micologico. Non dimenticarti di effettuare l'accesso! </p>
								<a href="{$root}forum/forum.php" class="button">FORUM</a>
							</section>
						</div>
						<div class="4u">
							<section>
								<a href="{$root}lettera_esperto.php" class="image full"><img src="{$root}images/pics03.jpg" alt=""></a>
								<p>CHIEDI ALL'ESPERTO è il modo più semplice per rivolgere domande dirette ai nostri micologi professionisti pronti ad aiutarti!</p>
								<a href="{$root}lettera_esperto.php" class="button">CHIEDI ALL'ESPERTO</a>
							</section>
						</div>
					</div>
				</section>
			</div>
                                                                <br>
		</div>
{/block}