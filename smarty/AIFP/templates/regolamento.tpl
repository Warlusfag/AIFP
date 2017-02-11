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
                <a href="#" class="image full"><img src="{$root}images/pics10.jpg" alt=""></a>
               {if $path!=null}
                    <a href="{$path}" download></a>
               {/if}
                
                
                <ul class="default">
                    <form action="{$root}funghi/regolamento.php" method="GET">
                    <a>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/abruzzo.png" width="78" height="78" alt="">
                            <br>Abruzzo<br>
                            <span class="posted"><button value="abruzzo" type="submit" class="button"> Download </button></span>
                            
                        </li><br>
                    </a>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/basilicata.png" width="78" height="78" alt="">
                            Basilicata<br>
                            <span class="posted"><button value="basilicata" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/calabria.png" width="78" height="78" alt="">
                            Calabria<br>
                            <span class="posted"><button value="calabria" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/campania.png" width="78" height="78" alt="">
                            Campania<br>
                            <span class="posted"><button value="campania" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/emiliaromagna.png" width="78" height="78" alt="">
                            Emilia Romagna<br>
                            <span class="posted"><button value="emiliaromagna" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/friuliveneziagiulia.png" width="78" height="78" alt="">
                            Friuli Venezia Giulia<br>
                            <span class="posted"><button value="friuliveneziagiulia" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/lazio.png" width="78" height="78" alt="">
                            Lazio<br>
                            <span class="posted"><button value="lazio" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/abruzzo.png" width="78" height="78" alt="">
                            Abruzzo<br>
                            <span class="posted"><button value="abruzzo" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/ligura.png" width="78" height="78" alt="">
                            Ligura<br>
                            <span class="posted"><button value="ligura" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/lombardia.png" width="78" height="78" alt="">
                            Lombardia<br>
                            <span class="posted"><button value="lombardia" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/marche.png" width="78" height="78" alt="">
                            Marche<br>
                            <span class="posted"><button value="marche" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/molise.png" width="78" height="78" alt="">
                            Molise<br>
                            <span class="posted"><button value="molise" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/piemonte.png" width="78" height="78" alt="">
                            Piemonte<br>
                            <span class="posted"><button value="piemonte" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/puglia.png" width="78" height="78" alt="">
                            Puglia<br>
                            <span class="posted"><button value="puglia" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/Sardegna.png" width="78" height="78" alt="">
                            Sardegna<br>
                            <span class="posted"><button value="sardegna" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/sicilia.png" width="78" height="78" alt="">
                            Sicilia<br>
                            <span class="posted"><button value="sicilia" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/toscana.png" width="78" height="78" alt="">
                            Toscana<br>
                            <span class="posted"><button value="toscana" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/trentinoaltoadige.png" width="78" height="78" alt="">
                            Trentino Alto Adige<br>
                            <span class="posted"><button value="trentinoaltoadige" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/umbria.png" width="78" height="78" alt="">
                            Umbria<br>
                            <span class="posted"><button value="umbria" type="submit" class="button"> Download </button></span>
                        </li>
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/valledaosta.png" width="78" height="78" alt="">
                            Valle D'Aosta<br>
                            <span class="posted"><button value="valledaosta" type="submit" class="button"> Download </button></span>
                        </li>
                        
                        <li  style="background-color: #eeeff2;">
                            <img src="{$root}images/foto_regioni/veneto.png" width="78" height="78" alt="">
                            Veneto<br>
                            <span class="posted"><button value="veneto" type="submit" class="button"> Download </button></span>
                        </li>
                        
                        
                        
                    
                    <br>
                    
                    </form>
                </ul>
        </section>
</div>
					
<!-- /Main -->

{/block}