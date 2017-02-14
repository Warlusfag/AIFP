{extends file="generic_page_sidebar.tpl"}
{block "title"}Conversazioni{/block}
{block name="buttom_main"}
{/block}



{block name="mainside"}
    <section>
         <ul class="style1"> 
             <li>
                <form action="{$root}forum/sezione.php" method="post">
                    <input name="sezione" value="{$sezione}" style="display:none">
                        <button class="button schede" type="submit" name="s_index" value="{$s_index}"> < {$sezione}</button>
                    </form>
             </li>
         </ul>
    </section>
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
                        <h2>{$conversazione}</h2>
                         <div class="4u" style="float:right;">
                        
                        </div>  
                </header>
                
      
               
                    <div class="row half">
                        <div class="10u">
                            <section>
                                    <header>
                                            <h3>{$conversazione}</h3>
                                    </header>
                                    <hr>
                                    {foreach $posts as $p}
                                        <div class="15u" style="text-align:right;">
                                            {$p.time}
                                        </div>
                                        <div class="row half">
                                            <div class="2u">
                                                <img src="{$root}{$p.image}" class="pic"><br>
                                                <span><b>{$p.user}</b><br>{$p.tipo_user}</span>
                                            </div>
                                                                
                                            <div class="9u">
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
                                    <img src="{$root}{$profilo.image}" class="pic"><br>
                                    <span><b>{$profilo.user}</b><br> {$p.data}</span>
                                </div>
                                <form action="{$root}/forum/rispondi.php" method="post">
                                
                                <div class="9u" style="float:left;">
                                    
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