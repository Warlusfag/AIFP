{extends file="generic_page_sidebar.tpl"}
{block "title"}Schede Funghi{/block}
{block name=buttom_main}
{/block}	
{block name=mainside}
    {if $error != null}
        <script>
            document.getElementById('alert').style.display='block';
        </script>
    {/if} 
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
	
<div id="content" class="9u skel-cell-important">
    <section>
        <header>
            <h2>{$descrizione.genere}{$descrizione.specie}</h2>
        </header>
    </section>
        <div class="row half">
            <div class="3u">
                <img src="{$root}{$foto}">
            </div>
            <div class="4u">
                <ul>
                    <li><b>Commestibile</b> {$descrizione.commestiblie}</li>
                    <li><b>Sporata</b> {$descrizione.sporata}</li>
                    <li><b>Viraggio</b> {$descrizione.viraggio}</li>
                    <li><b>Cuticola Pelosità</b> {$descrizione.cuticola_pelosità}</li>
                    <li><b>Cuticola Umidità</b> {$descrizione.cuticola_umidità}</li>
                </ul>
                
            </div>
            <div class="4u">
                <ul>
                    <li><b>Imenio</b> {$descrizione.imenio}</li>
                    <li><b>Anello</b> {$descrizione.anello}</li>
                    <li><b>Volva</b> {$descrizione.volva}</li>
                    <li><b>Habitat</b> {$descrizione.habitat}</li>
                    <li><b>Stagione</b> {$descrizione.stagione}</li>
                </ul>
            </div>
                <hr>
            <div class="11u">
                <ul>
                    <li><b>Cappello</b> {$descrizione.cappello}</li>
                    <li><b>Colore</b> {$descrizione.colore}</li>
                    <li><b>Gambo</b> {$descrizione.gambo}</li>
                    <li><b>Pianta</b> {$descrizione.pianta}</li>
                    <li><b>Descrizione</b> {$descrizione.descrione}</li>
                </ul>         

            </div>
</div>


{/block}