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
                    <a type="button" onclick="document.getElementById('id01').style.display='block'" href="#">Accedi</a>
                {else}
                    <p> Benvenuto {$user} </p>
                {/if}

              
        </section>
        </div>
               
	<!-- /Main -->

{/block}