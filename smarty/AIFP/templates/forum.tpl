{extends file="generic_page_sidebar.tpl"}
	{block "title"}Forum{/block}
        {block name="buttom_main"}
            {/block}
        
        
	{block name=main}  
            
            
        <!-- Main -->
        <div id="content" class="9u skel-cell-important">
        <section>
                <header>
                        <h2>Forum</h2>
                </header>
                
      
              
                    <div class="row half">
                        <div class="10u">
                            <section>
                                    <header>
                                            <h4>Ultime sezioni</h4>
                                    </header>
                                    <form action="{$root}forum/sezione.php" type="get">
                                        <ul class="default">
                                            {$count=-1}
                                            
                                            {foreach $sez as $s}
                                                    {$count=$count+1}
                                                    <button class="sezione" name="sezione" method="post" value="{$count}" type="submit">
                                                    <li>
                                                        <div class="row half">
                                                            <div class="7u" style="float:left;">
                                                                <br>
                                                                <span style="font-size:20px;"><strong>{$s.id_sez} {$s.nome}</strong></span>
                                                                <br>
                                                                <p>{$s.descrizione}</p>
                                                            </div>
                                                            <div class="3u" style="float:right;">
                                                                <br>
                                                                <span> Moderatore:<strong> {$s.moderatore}  <br>  {$s.num_conv}</strong> commenti</span>
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
        </div>
               
	<!-- /Main -->

{/block}