{extends file="generic_page_sidebar.tpl"}
	{block "title"}Forum{/block}
        {block name=userside}
        {/block}

        {block name=mainside}
            <section>
            <header>
                <h2>TERMOSTATO</h2>
            </header>
            <ul class="style1">
                <li>IDEE PER LA SIDE DEL FORUM?</li>
                <li>BBBBBBBBBBB</li>
                <li>QUANTO ODII QUEST'IMMAGINE? -------></li>
                <li>DDDDDDDDDDD</li>
            </ul>
    </section>
        {/block}
        
        
	{block name=main}  
            
            
        <!-- Main -->
        <div id="content" class="9u skel-cell-important">
        <section>
                <header>
                        <h2>Forum</h2>
                </header>
                <a href="#" class="image full"><img src="../images/pics10.jpg" alt=""></a>
                <p>Benvenuti nel nostro forum</p>
               
                    <div class="row half">
                        <div class="9u">
                            <section>
                                    <header>
                                            <h2>Ultime sezioni</h2>
                                    </header>
                                    <form action="{$root}forum/conversazione.php" type="get">
                                        <ul class="default">
                                            {foreach $sez as $s}
                                                    
                                                    <li>
                                                        <button class="sezione" type="submit">
                                                            <p style="font-size:24px;">{$s[0]} {$s[1]}</p><br>
                                                            <span> Moderatore: {$s[2]}  |  {$s[3]} commenti</span>
                                                        </button>

                                                    </li>

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