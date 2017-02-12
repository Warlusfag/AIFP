{extends file="generic_page_sidebar.tpl"}
	{block "title"}Conversazioni{/block}
        {block name="buttom_main"}
            {/block}
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
            
        
{block name=main}  
            
            
        <!-- Main -->
        <div id="content" class="9u skel-cell-important">
        <section>
                <header>
                        <h3>{$conversazioni}</h3>
                         <div class="4u" style="float:right;">
                        <form action="{$root}forum/sezione.php" method="post">
                            <input name="sezione" value="{$sezione}" style="display:none">
                            <button class="button prec" type="submit" name="s_index" value="{$s_index}"> < </button>
                        </form>
                        </div>  
                </header>
                
      
               
                    <div class="row half">
                        <div class="10u">
                            <section>
                                    <header>
                                            <h3>{$sezione}</h3>
                                    </header>
                                    {foreach $posts as $p}
                                        <div class="row half">
                                            <div class="2u">
                                                <img src="{$root}{$p.image}" class="pic"><br>
                                                <span><b>{$p.user}</b><br>{$p.data}</span>
                                            </div>
                                                                
                                            <div class="9u">
                                                <br>
                                                <p>{$p.text}</p>
                                                <br>
                                            </div>
                                            
                                        </div>
                                        <hr>
                                    {/foreach}
                            </section>
                        </div>
                        <div class="10u">
                            <div class="row half">
                                <div class="2u">
                                    <img src="{$profilo.image}" class="pic"><br>
                                    <span><b>{$p.user}</b><br> {$p.data}</span>
                                </div>
                                <form action="{$root}/forum/rispondi.php" method="post">
                                
                                <div class="9u" style="float:left;">
                                    <br>
                                    <textarea rows='3' cols='50' style="resize:none;" placeholder="Rispondi..." name="text" required></textarea>
                                    <input name="sezione" value="{$sezione}" style="display:none;">
                                    <input name="conversazione" value="{$conversazione}" style="display:none;">
                                    <input name="c_index" value="{$c_index}" style="display:none;">
                                    <input name="s_index" value="{$s_index}" style="display:none;">
                                    <button type="submit" class="button personal">Rispondi</button> 
                                </div>
                                </form>
                            </div>    
                        </div>
                    </div>
                                <br><br>
        </section>
{/block}