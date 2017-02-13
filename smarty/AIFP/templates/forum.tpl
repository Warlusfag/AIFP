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
                    
                    
                

              
        </section>
        </div>
               
	<!-- /Main -->

{/block}