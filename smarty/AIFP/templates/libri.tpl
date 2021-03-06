{extends file="generic_page_sidebar.tpl"}
{block name=title}Libri{/block}


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
{if $error}
<script>
    document.getElementById('alert').style.display='block';
</script>
{/if}
{if $message}
<script>
document.getElementById('success').style.display='block';
</script>
{/if}
	<!-- Main -->
    <div id="content" class="9u skel-cell-important">
            <section>
                    <header>
                            <h2>LIBRI</h2>
                    </header>
                    <a href="#" class="image full"><img src="../images/pics10.jpg" alt=""></a>
                    <p>Qui troverete la lista di tutti i libri consigliati dal nostro esperto Dott. Ing. Gabriele Faggioni, il micologo wild</p>
                    <ul class="default">
                            <li><img src="../images/pics04.jpg" width="78" height="78" alt="">
                                    <p>I funghi dal vero</p>
                                    <span class="posted">Libro di Bruno Cetto</span>

                            </li>
                            <li><img src="../images/pics05.jpg" width="78" height="78" alt="">
                                    <p>Funghi medicinali. Dalla tradizione alla scienza.</p>
                                    <span class="posted">Libro di Stefania Cazzavillan</span>
                            </li>
                            <li><img src="../images/pics06.jpg" width="78" height="78" alt="">
                                    <p>Psicofunghi italiani.</p>
                                    <span class="posted">Libro di Gilbero Camilla</span>
                            </li>
                            <li><img src="../images/pics06.jpg" width="78" height="78" alt="">
                                    <p>I funghi tossici e velenosi.</p>
                                    <span class="posted">Libro di Enric Lazzarini</span>
                            </li>
                            <li><img src="../images/pics06.jpg" width="78" height="78" alt="">
                                    <p>Psicofunghi italiani.</p>
                                    <span class="posted">Libro di Gilbero Camilla</span>
                            </li>
                    </ul>
            </section>
    </div>
	<!-- /Main -->
{/block}
