{extends file="generic_page_sidebar.tpl"}

{block "title"}Regolamento{/block}

{block name=mainside}
     <section>
        <header>
            <h2>Overview</h2>
        </header>
        <ul class="style1"> 
            <li><a href="{$root}funghi/storia.php">Storia del fungo</a></li>
            <li><a href="{$root}funghi/schede_funghi.php">Schede Funghi</a></li>
            <li><a href="{$root}prodotti/libri.php">Libri e Guide</a></button></li>
            <li><a href="{$root}funghi/regolamento.php">Regolamenti</a></button></li>
        </ul>
    </section>
{/block}
        
{block name=main}  
	<!-- Main -->
<!-- Main -->

<div id="content" class="9u skel-cell-important">
        <section>
                <header>
                        <h2>REGOLAMENTI</h2>
                </header>
              
                {if $path!=null}
                    <a id="down" style="display:none;" href="{$root}{$path}" download>download</a>
                {/if}
                
                {if $profilo.user}
                 <section>
                        <header>
                            <h3>Scarica il regolamento della tua regione </h3>
                        </header>
                        <form action="{$root}funghi/regolamento.php" method="get">
                            <button type="submit" class="button regole" name="miaregione" value="1"> Download</button>
                       
                        </form>
                    </section>
                {/if}
                            <hr>
                
                <form action="{$root}funghi/regolamento.php" method="get">
                    <div class="row half">
                        <div class="3u">
                        <button value="abruzzo" name="regione" type="submit" class="button regole">
                                <img src="{$root}images/foto_regioni/abruzzo.gif" width="50" height="50" alt="">
                            <br>Abruzzo<br>
                             <span>Download</span> </button>
                        </div>
                            <div class="3u">
                            <button value="basilicata" name="regione" type="submit" class="button regole"> 
                            <img src="{$root}images/foto_regioni/basilicata.gif" width="50" height="50" alt="">
                            <br>Basilicata<br>
                             Download </button>
                            <br>
                        </div>
                            <div class="3u">
                            <button value="calabria" name="regione" type="submit" class="button regole"> 
                            <img src="{$root}images/foto_regioni/calabria.gif" width="50" height="50" alt="">
                            <br>Calabria<br>
                            Download </button>
                            <br>
                        </div>
                            <div class="3u">
                             <button value="emiliaromagna" name="regione" type="submit" class="button regole"> 
                            <img src="{$root}images/foto_regioni/emiliaromagna.gif" width="50" height="50" alt="">
                            <br>Emilia<br>
                           
                            Download </button>
                        </div>
                            <div class="3u">
                            <button value="friuliveneziagiulia" name="regione" type="submit" class="button regole">
                            <img src="{$root}images/foto_regioni/friuliveneziagiulia.gif" width="50" height="50" alt="">
                            <br>Friuli<br>
                              Download </button> 
                        </div>
                            <div class="3u">
                             <button value="lazio" name="regione" type="submit" class="button regole">
                            <img src="{$root}images/foto_regioni/lazio.gif" width="50" height="50" alt="">
                            <br>Lazio<br>
                             Download </button> 
                        </div>
                            <div class="3u">
                            <button value="liguria" name="regione" type="submit" class="button regole">
                            <img src="{$root}images/foto_regioni/liguria.gif" width="50" height="50" alt="">
                            <br>Liguria<br>
                              Download </button> 
                        </div>
                            <div class="3u">
                            <button value="lombardia" name="regione" type="submit" class="button regole">
                            <img src="{$root}images/foto_regioni/lombardia.gif" width="50" height="50" alt="">
                            <br>Lombardia<br>
                              Download </button> 
                        </div>
                         <div class="3u">
                         <button value="marche" name="regione" type="submit" class="button regole">
                            <img src="{$root}images/foto_regioni/marche.gif" width="50" height="50" alt="">
                            <br>Marche<br>
                              Download </button> 
                        </div>
                         <div class="3u">
                         <button value="molise" name="regione" type="submit" class="button regole">
                            <img src="{$root}images/foto_regioni/molise.gif" width="50" height="50" alt="">
                            <br>Molise<br>
                              Download </button> 
                        </div>
                         <div class="3u">
                         <button value="piemonte" name="regione" type="submit" class="button regole">
                            <img src="{$root}images/foto_regioni/piemonte.gif" width="50" height="50" alt="">
                            <br>Piemonte<br>
                              Download </button> 
                        </div>
                         <div class="3u">
                         <button value="puglia" name="regione" type="submit" class="button regole">
                            <img src="{$root}images/foto_regioni/puglia.gif" width="50" height="50" alt="">
                            <br>Puglia<br>
                              Download </button> 
                        </div>
                         <div class="3u">
                         <button value="sardegna" name="regione" type="submit" class="button regole">
                            <img src="{$root}images/foto_regioni/sardegna.gif" width="50" height="50" alt="">
                            <br>Sardegna<br>
                              Download </button> 
                        </div>
                         <div class="3u">
                         <button value="sicilia" name="regione" type="submit" class="button regole">
                            <img src="{$root}images/foto_regioni/sicilia.gif" width="50" height="50" alt="">
                            <br>Sicilia<br>
                              Download </button> 
                        </div>
                         <div class="3u">
                          <button value="toscana" name="regione" type="submit" class="button regole">
                            <img src="{$root}images/foto_regioni/toscana.gif" width="50" height="50" alt="">
                            <br>Toscana<br>
                             Download </button> 
                        </div>
                         <div class="3u">
                         <button value="trentinoaltoadige" name="regione" type="submit" class="button regole">
                            <img src="{$root}images/foto_regioni/trentinoaltoadige.gif" width="50" height="50" alt="">
                            <br>Trentino<br>
                              Download </button> 
                        </div>
                         <div class="3u">
                         <button value="umbria" name="regione" type="submit" class="button regole">
                            <img src="{$root}images/foto_regioni/umbria.gif" width="50" height="50" alt="">
                            <br>Umbria<br>
                              Download </button> 
                        </div>
                         <div class="3u">
                         <button value="valledaosta" name="regione" type="submit" class="button regole">
                            <img src="{$root}images/foto_regioni/valledaosta.gif" width="50" height="50" alt="">
                            <br>D'Aosta<br>
                              Download </button> 

                        </div>
                         <div class="3u">
                         <button value="veneto" name="regione" type="submit" class="button regole">
                            <img src="{$root}images/foto_regioni/veneto.gif" width="50" height="50" alt="">
                            <br>Veneto<br>
                              Download </button> 
                        </div>
                    </div>
                    </form>
                   
                
        </section>
</div>
					
<!-- /Main -->

{/block}