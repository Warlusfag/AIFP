{extends file="generic_page_sidebar.tpl"}
	{block "title"}Conversazioni{/block}
        {block name="buttom_main"}
            {/block}
        
        
{block name=main}  
            
            
        <!-- Main -->
        <div id="content" class="9u skel-cell-important">
        <section>
                <header>
                        
                </header>
            
                <div class="10u">
                    
                    <a class="button" onclick="document.getElementById('conv').style.display='block'" href="#">Crea una nuova conversazione</a>
                </div>
            
            <hr>
      
               
                    <div class="row half">
                        <div class="10u">
                            <section>
                                    <header>
                                        <h3>Sezioni</h3>
                                    </header>
                                <form action="{$root}forum/conversazione.php" type="post">
                                        <ul class="default">
                                            {$count=-1}
                                            
                                            {foreach $convs as $c}
                                                    {$count=$count+1}
                                                    <input name="sezione" value="{$c.sezione}" style="display:none;">
                                                    <button class="sezione" name="conversazione" method="post" value="{$count}" type="submit">
                                                    <li>
                                                        <div class="row half">
                                                            <div class="7u" style="float:left;">
                                                                <br>
                                                                <span style="font-size:20px;"><strong>{$c.id_convs} {$c.titolo}</strong></span>
                                                                <br>
                                                            </div>
                                                            <div class="3u" style="float:right;">
                                                                <br>
                                                                <span> Numero post:<strong> {$c.num_post}  <br>  Data: {$c.data}</strong></span>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                      

                                                    </li>
                                                    </button>
                                            {/foreach}
                                        </ul>
                                    </form>
                            </section>
                        </div>
                    </div>
        </section>
                                            
                                            
<div id="conv" class="modal">
                            <form name="conv" class="modal-content animate" method="post" action="{$root}forum/nuova_conversazione.php">
                            	 <div class="logcontainer" style="background-color: #f1f1f1">
                                	
                                	
                                	<label><b>Nuova Conversazione</b></label>
                                </div>
                                <div class="imgcontainer">
                                	<span onclick="document.getElementById('conv').style.display='none'" class="close" title="Chiudi">&times;</span>
                                </div>

                                <div class="logcontainer">
                                    <input type="text" placeholder="Inserisci Titolo" name="titolo" required>
                                    <br><br>
                                    <textarea rows='6' cols='55' style="resize:none;" placeholder="Inserisci Testo" name="text" required></textarea><br>
                                    <br><hr>
                                    <input value="{$sezione}" name="sezione" style="display:none;">
                                    <button class="loginbtn" type="submit">Crea</button>
                                    <br>
                                    
                                </div>
                                <div class="logcontainer" style="background-color:#f1f1f1">
                                	  
                                    
                                </div>
                            </form>
                        </div>
                                            
{/block}