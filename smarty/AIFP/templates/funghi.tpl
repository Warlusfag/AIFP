{extends file="generic_page_sidebar.tpl"}
{block name=title}Funghi{/block}
   





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
    
    {if $message}
<script>
    document.getElementById('success').style.display='block';
</script>
{/if}
{if $error}
<script>
    document.getElementById('alert').style.display='block';
</script>
{/if} 
	<!-- Main -->
    <div id="content" class="9u skel-cell-important">
            <section>
                    <header>
                            <h2>FUNGHI</h2>
                    </header>
                    <a href="#" class="image full"><img src="../images/pics10.jpg" alt=""></a>
                    <p>In questa sezione blabla blaa Nam pede erat, porta eu, lobortis eget, tempus et, tellus. Etiam neque. Vivamus consequat lorem at nisl. Nullam non wisi a sem semper eleifend. Donec mattis libero eget urna. Duis pretium velit ac mauris. Proin eu wisi suscipit nulla suscipit interdum.</p>
            </section>
            <section>
                    <header>
                            <h4>Tutto ciò che puoi sapere sul mondo micologico</h4>
                    </header>
                    <div class="row">
                            <div class="4u">
                                    <section>
                                            <a href="{$root}funghi/storia.php" class="image full"><img src="../images/pics01.jpg" alt=""></a>
                                            <p>La micologia e le sue scoperte scientifiche </p>
                                            <a href="{$root}funghi/storia.php" class="button">STORIA</a>
                                    </section>
                            </div>
                            <div class="4u">
                                    <section>
                                            <a href="{$root}funghi/schede_funghi.php" class="image full"><img src="../images/pics02.jpg" alt=""></a>
                                            <p>Schede di tutti i fottuti funghi allucinogeni e non</p>
                                            <a href="{$root}funghi/schede_funghi.php" class="button">SCHEDE</a>
                                    </section>
                            </div>
                            <div class="4u">
                                    <section>
                                            <a href="{$root}prodotti/libri.php" class="image full"><img src="../images/pics03.jpg" alt=""></a>
                                            <p>Libri consigliati dal nostro esperto, dott.Faggioni</p>
                                            <a href="{$root} prodotti/libri.php" class="button">LIBRI</a>
                                    </section>
                            </div>

                    </div>
            </section>
    </div>
<!-- /Main -->
{/block}

