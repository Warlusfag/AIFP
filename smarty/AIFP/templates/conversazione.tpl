{extends file="generic_page_sidebar.tpl"}
	{block "title"}Conversazioni{/block}
        {block name="buttom_main"}
            {/block}
        
        
{block name=main}  
            
            
        <!-- Main -->
        <div id="content" class="9u skel-cell-important">
        <section>
                <header>
                        <h3>Post</h3>
                </header>
                
      
               
                    <div class="row half">
                        <div class="10u">
                            <section>
                                    <header>
                                            <h4></h4>
                                    </header>
                              
                                        
                                            {$count=-1}
                                            
                                            {foreach $posts as $p}
                                                    {$count=$count+1}
                                                   
                                                        <div class="row half">
                                                            <div class="4u">
                                                                <img src="{$root}{$p.image}" class="pic"><br>
                                                                <span>{$p.user} Punteggio: {$p.punteggio}</span>
                                                            </div>
                                                                
                                                            <div class="7u" style="float:left;">
                                                                <br>
                                                                <p>{$p.text}</p>
                                                                <br>
                                                            </div>
                                                                <hr>
                                                        </div>
                                                        
                                                        
                                                        
                                                      

                                                    
                                                    </button>
                                            {/foreach}
                                        
                                    </form>
                            </section>
                        </div>
                    </div>
        </section>
{/block}