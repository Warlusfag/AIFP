{extends file="generic_page.tpl"}
    {block "title"}AIFP{/block}
	{block name=main}  
	<!-- Main -->
    <div class="row half">
        <div class="7u">
          <section>
                    <header>
                            <h2>@NOME_UTENTE</h2>
                    </header>
              <img src="{$root}images/img_avatar.png" class="pic"><br>
                    <a href="#" class="button">Modifica Immagine del Profilo</a>
            </section>
        </div>
        <div class="5u">
            <section>
                <header></header><br><br>
                <p> Nome e cognome </p><br>
                <p> Residenza </p><br>
                <p> Data di nascita </p><br><br> 
                <a href="#" class="button">Modifica Dati personali</a>
            </section>
        </div>
           
    </div>
                    
        
       
       
        
                
           	<!-- /Main -->

{/block}