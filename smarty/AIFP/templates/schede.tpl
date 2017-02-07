{extends file="generic_page_sidebar.tpl"}
	{block "title"}Schede Funghi{/block}
	
	{block name=main}  
	<!-- Main -->
<!-- Main -->
	
        <div id="content" class="9u skel-cell-important">
            <section>
                <header>
                    <h2>SCHEDE FUNGHI</h2>
                </header>
                <a href="#" class="image full"><img src="../images/pics10.jpg" alt=""></a>
                
                <div class="row">
                    {foreach $genere as $gen}
                    <div class="4u">
                            <section>
                                    <a href="" class="image full"><img src="{$root}{$gen[1]}" alt=""></a>
                                    <a href="{$root}funghi/{$gen[0]}.php" class="button">{$gen}</a>
                            </section>
                    </div>
                    {/foreach}
                </div>
                
                 
                
            </section>
        </div>
           
<!-- /Main -->

{/block}