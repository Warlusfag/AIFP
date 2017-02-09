{extends file="generic_page_sidebar.tpl"}
{assign	"root" "/AIFP/"}
	{block "title"}Regolamento{/block}
	{block name=main}  
	<!-- Main -->
<!-- Main -->

<div id="content" class="9u skel-cell-important">
        <section>
                <header>
                        <h2>REGOLAMENTO</h2>
                </header>
                <a href="#" class="image full"><img src="{$root}images/pics10.jpg" alt=""></a>
               
                <ul class="default">
                     {foreach $path as $regione}
                     <a href="{$regione}" download>
                        <li  style="background-color: #eeeff2;"><img src="{$root}images/foto_regioni/{$regione}.jpg" width="78" height="78" alt="">
                            {$regione}<br>
                            <span class="posted">Clicca per download</span>
                        </li>
                     </a>
                    <br>
                    {/foreach}
                    
                </ul>
        </section>
</div>
					
<!-- /Main -->

{/block}