{extends file="generic_page_sidebar.tpl"}
	{block "title"}Conversazioni{/block}
        {block name="buttom_main"}
            {/block}
        
        
{block name=main}  
            
            
        <!-- Main -->
        <div id="content" class="9u skel-cell-important">
        <section>
                <header>
                        <h2>Conversazioni</h2>
                </header>
                
      
               
                    <div class="row half">
                        <div class="10u">
                            <section>
                                    <header>
                                            <h4></h4>
                                    </header>
                                <form action="{$root}forum/conversazione.php" type="get">
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
                                                                <span> Numero post:<strong> {$c.num_post}  <br>  Data: {$s.data}</strong></span>
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
{/block}