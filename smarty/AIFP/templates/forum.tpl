{extends file="generic_page_sidebar.tpl"}
	{block "title"}Forum{/block}
	{block name=main}  

        <!-- Main -->
        <div id="content" class="9u skel-cell-important">
        <section>
                <header>
                        <h2>Forum</h2>
                </header>
                <a href="#" class="image full"><img src="../images/pics10.jpg" alt=""></a>
                <p>Benvenuti nel nostro forum</p>
                {if $user==null}
                    <p>Esegui l'accesso per continuare</p>
                    <a type="button" onclick="document.getElementById('login').style.display='block'" href="#">Accedi</a>
                {else}
                    <div class="row half">
                        <div class="9u">
                            <section>
                                    <header>
                                            <h2>Ultime sezioni</h2>
                                    </header>
                                
                                    <ul class="default">
                                        {foreach $sez as $s}
                                            <li  style="background-color: #eeeff2;">
                                                <img src="{$root}images/pics04.jpg" width="78" height="78" alt="">
                                                <p>Id:{$s[0]} Nome:{$s[1]}</p><br>
                                                <span class="posted">Moderatore: {$s[3]}  |  {$s[3]} commenti</span>
                                            </li>
                                        {/foreach}
                                    </ul>
                            </section>
                        </div>
                    </div>
                    
                    
                {/if}

              
        </section>
        </div>
               
	<!-- /Main -->

{/block}