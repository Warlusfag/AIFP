{extends file="generic_page2.tpl"}
{assign	"root" "/AIFP/"}

	{block name=main}  
		<div id="main">
		
					
			<div class="container center">
                            <section class="container center">
					<header>
						<h2>Registrazione</h2>
					</header>
					<div class="row">
					<div class="2u sin">
							<section>
								<a href="{$root}profilize/reg_user.php" class="image full"><img src="../images/ico1.png" alt=""></a>
								
								<a href="{$root}profilize/reg_user.php" class="button">Utente</a>
							</section>
						</div>
						
						<div class="2u des">
							<section>
								<a href="{$root}profilize/reg_assoc.php" class="image full"><img src="../images/ico2.png     " alt=""></a>
								
								<a href="{$root}profilize/reg_assoc.php" class="button">Associazione</a>
							</section>
						</div>
					
					</div>
				</section>
					
			</div>
		</div>
	<!-- /Main -->


	{/block}