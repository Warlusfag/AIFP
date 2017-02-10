{extends file="generic_page_sidebar.tpl"}
	{block "title"}Forum{/block}
        
        
        
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
                                    <form action="{$root}forum/conversazione.php" type="get">
                                        <ul class="default">
                                            {foreach $sez as $s}
                                                    <button class="sezione" type="submit">
                                                    <li>
                                                        <br>
                                                        <p style="font-size:20px;">{$s[0]} {$s[1]}</p>
                                                        <span> Moderatore: {$s[2]}  |  {$s[3]} commenti</span>
                                                      

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