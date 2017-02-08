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
                     {foreach $path ah $reg}
                         {$reg}
                     <a href="{$root}funghi/regolamenti/abruzzo.pdf" download>
                        <li  style="background-color: #eeeff2;"><img src="{$root}images/pics04.jpg" width="78" height="78" alt="">
                            Abruzzo<br>
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