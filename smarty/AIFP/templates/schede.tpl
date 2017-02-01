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
                    {foreach $genere as $value}
                    <div class="4u">
                            <section>
                                    <a href="#" class="image full"><img src="{$root}images/pics01.jpg" alt=""></a>
                                    <a href="#" class="button">{$genere}</a>
                            </section>
                    </div>
                    {/foreach}
                </div>
                
                 
                
            </section>
        </div>
           
<!-- /Main -->

{/block}