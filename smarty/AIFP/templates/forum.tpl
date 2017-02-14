{extends file="generic_page_sidebar.tpl"}
	{block "title"}Forum{/block}
        {block name="buttom_main"}
        {/block}
        

	{block name=main}  
            
                    
        {if $message}
        <script>
            document.getElementById('success').style.display='block';
        </script>
        {/if}
        {if $error}
        <script>
            document.getElementById('alert').style.display='block';
        </script>
        {/if} 
        
        <!-- Main -->
        <div id="content" class="9u skel-cell-important">
            <section>
            <header>
                <h2>FORUM</h2>
            </header>
            {if $profilo.type=="admin"}
            <div class="10u">
                <a class="button sezio" onclick="document.getElementById('sez').style.display='block'" href="#">Crea una nuova sezione</a>
            </div>
            {/if}
            </section>
              
                    <div class="row half">
                        <div class="10u">
                            <section>
                                    <header>
                                            <h4>Ultime sezioni</h4>
                                    </header>
                                    
                                        <ul class="default">
                                            {$count=-1}
                                            
                                            {foreach $sez as $s}
                                                    {$count=$count+1}
                                                    <form action="{$root}forum/sezione.php" method="post">
                                                    <input name="s_index" value="{$count}" style="display:none;">
                                                    <button class="sezione" name="sezione" value="{$s.nome}" type="submit">
                                                      
                                                    <li>
                                                        <div class="row half">
                                                            <div class="8u">
                                                                <br>
                                                                <span style="font-size:20px;"><strong>{$s.id_sez} {$s.nome}</strong></span>
                                                                <br>
                                                                <p>{$s.descrizione}</p>
                                                            </div>
                                                            <div class="2u" style="float:right;border-left: solid 1px #ddd;">
                                                                <br>
                                                                <span> Moderatore:<strong> {$s.moderatore}  <br>  {$s.num_conv}</strong> commenti</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    </form>
                                                    </button>
                                            {/foreach}
                                        </ul>
                                    
                            </section>
                        </div>
                    </div>

        </div>
               
	<div id="sez" class="modal">
                            <form name="sezione" class="modal-content animate" method="post" action="{$root}forum/add_sezione.php">
                            	 <div class="logcontainer" style="background-color: #f1f1f1">
                                	<label><b>Nuova Sezione</b></label>
                                </div>
                                <div class="imgcontainer">
                                	<span onclick="document.getElementById('sez').style.display='none'" class="close" title="Chiudi">&times;</span>
                                </div>

                                <div class="logcontainer">
                                    <input type="text" placeholder="Inserisci Titolo" name="nome" required>
                                    <br><br>
                                    <input type="text" placeholder="Inserisci Moderatore" name="moderatore" required>
                                    <br><br>
                                    <textarea rows='6' cols='55' style="resize:none;" placeholder="Inserisci Descrizione" name="descrizione" required></textarea><br>
                                    <br><hr>
                                    <input value="{$s_index}" name="s_index" style="display:none;">
                                    <button class="loginbtn" name="sezione" value="{$sezione}" type="submit">Crea</button>
                                    <br>
                                    
                                </div>
                                <div class="logcontainer" style="background-color:#f1f1f1">
                                	  
                                    
                                </div>
                            </form>
                        </div>

{/block}