{extends file="generic_page_sidebar.tpl"}
	{block "title"}Conversazioni{/block}
        {block name="buttom_main"}
            {/block}
        
        
{block name=main}  
            
        {if $error!=null}
                                 <script>
                                     document.getElementById('alert').style.display='block';
                                </script>
                            {/if}
                             {if $message!=null}
                            <script>
                               document.getElementById('success').style.display='block';
                                 </script>
                            {/if}
        <!-- Main -->
        
        
       
        
        <div id="content" class="9u skel-cell-important">
        <section>
                <header>
                    <h3>{$sezione}</h3>
                    <div class="4u" style="float:right;">
                        <a href="{$root}/forum/forum.php" class="button prec"> < </button></a>
                    </div>
                </header>
            
                <div class="10u">
                    
                    <a class="button" onclick="document.getElementById('conv').style.display='block'" href="#">Crea una nuova conversazione</a>
                </div>
            
            <hr>
      
               
                    <div class="row half">
                        <div class="10u">
                            <section>
                                    <header>
                                        <h3></h3>
                                    </header>
                                <form action="{$root}forum/conversazione.php" method="post">
                                        <ul class="default">
                                            {$count=-1}
                                            
                                            {foreach $convs as $c}
                                                    {$count=$count+1}
                                                    <input name="conversazione" value="{$c.titolo}" style="display:none;">
                                                    <input name="s_index" value="{$s_index}" style="display:none;">
                                                    <button class="sezione" name="c_index" value="{$count}" type="submit">
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
                                    <input value="{$s_index}" name="s_index" style="display:none;">
                                    <button class="loginbtn" name="sezione" value="{$sezione}" type="submit">Crea</button>
                                    <br>
                                    
                                </div>
                                <div class="logcontainer" style="background-color:#f1f1f1">
                                	  
                                    
                                </div>
                            </form>
                        </div>
                         
                                    
     
                                    
{/block}