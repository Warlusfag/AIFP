{extends file="generic_page.tpl"}
{assign	"root" "/AIFP/"}

	{block name=main}  
		<div id="index">
					
			<div class="container">
                            <section>
					<header>
						<h2>Registrazione</h2>
					</header>
					<div class="row">
					<div class="2u sin">
							<section>
								<a onclick="document.getElementById('id02').style.display='block'" href="#" class="image full"><img src="../images/ico1.png" alt=""></a>
								
								<a onclick="document.getElementById('id02').style.display='block'" href="#" class="button">Utente</a>
							</section>
						</div>
						
						<div class="2u des">
							<section>
								<a onclick="document.getElementById('id03').style.display='block'" href="#"" class="image full"><img src="../images/ico2.png     " alt=""></a>
								
								<a onclick="document.getElementById('id03').style.display='block'" href="#" class="button">Associazione</a>
							</section>
						</div>
					
					</div>
                                                        
                                       
				</section>
					
			</div>
                                                        
                         <!-- User registration -->
                        <div id="id02" class="modal">
                        
                            <form class="modal-content animate" method="post" action="{$root}profilize/reg_user.php">
                                <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Chiudi">&times;</span>
                                <div class="logcontainer" style="background-color: #f1f1f1">
                                    <label><b>REGISTRATI COME UTENTE</b></label>
                                </div>
                              

                                <div class="logcontainer">
                                    <label><b>Dettagli Account</b></label><br>
                                    <input type="text" placeholder="Inserisci Nome Utente" name="user" required><br>
                                    <input type="text" placeholder="Inserisci E-Mail" name="email" required><br>    
                                    <input type="password" placeholder="Inserisci Password" name="password" required><br>
                                    <input type="password" placeholder="Conferma Password" name="psw-repeat" required><br>
                                    
                                    <label><b>Dettagli Profilo</b></label><br>
                                    <input type="text" placeholder="Inserisci Nome" name="nome" required><br>
                                    <input type="text" placeholder="Inserisci Cognome" name="cognome" required><br>
                                    <input type="text" placeholder="Inserisci Residenza" name="residenza" required><br>
                                                                  
                                    
                                    <div class="clearfix">
                                        <button type="submit" class="signupbtn">Registrati</button>
                                        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>          
                                
                       <!-- Association registration -->
                        <div id="id03" class="modal">
                            <form class="modal-content animate" method="post" action="{$root}profilize/reg_assoc.php">
                                <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Chiudi">&times;</span>
                                <div class="logcontainer" style="background-color: #f1f1f1">
                                    <label><b>REGISTRATI COME ASSOCIAZIONE</b></label>
                                </div>
                              

                                <div class="logcontainer">
                                    <label><b>Dettagli Account</b></label><br>
                                    <input type="text" placeholder="Inserisci Nome Utente" name="user" required><br>
                                    <input type="text" placeholder="Inserisci E-Mail" name="email" required><br>    
                                    <input type="password" placeholder="Inserisci Password" name="password" required><br>
                                    <input type="password" placeholder="Conferma Password" name="psw-repeat" required><br>
                                    
                                    <label><b>Dettagli Associazione</b></label><br>
                                    <input type="text" placeholder="Inserisci Nome" name="nome" required><br>
                                    <input type="text" placeholder="Inserisci Provincia" name="provincia" required><br>
                                    <input type="text" placeholder="Inserisci CAP" name="cap" required><br>
                                    <input type="text" placeholder="Inserisci Sito Web" name="sito_web" required><br>
                                    <input type="text" placeholder="Inserisci Componenti" name="componenti" required><br>
                                    
                                                                  
                                    
                                    <div class="clearfix">
                                        <button type="submit" class="signupbtn">Registrati</button>
                                        <button type="button" onclick="document.getElementById('id03').style.display='none'" class="cancelbtn">Cancel</button>
                                    </div>
                                </div>
                                
                            </form>
                            
                        </div>
		</div>
	<!-- /Main -->


	{/block}