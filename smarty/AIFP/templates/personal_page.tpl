{extends file="generic_page_sidebar.tpl"}
{block "title"}{$user}{/block}

{block name=userside}
{/block}

{block name=mainside}
    <script>
    
    </script>
    
    <section>
        <header>
            <h2>Profilo</h2>
        </header>
        <img src="{$root}images/img_avatar.png" class="pic">
        <ul class="style1">
            <li><button class="button" onclick="show('form1')" >Modifica Profilo</button></li>
            <li><button class="button" onclick="show('form2')" >FORM 2</button></li>
            <li><button class="button" onclick="show('form3')" >FORM 3</button></li>
            <li><button class="button" onclick="show('form4')" >FORM 4</button></li>
        </ul>
    </section>

    
    <section>
        
    </section>
{/block}

	{block name=main}  
	<!-- Main -->
    <div class="row half" id="form1">
        <div class="7u" >
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
                    
    <div class="row half" id="form2">
        <div class="7u" >
          <section>
                    <header>
                            <h2>FORM2</h2>
                    </header>
           </section>
        </div>
    </div>
                    
    <div class="row half" id="form3">
        <div class="7u" >
          <section>
                    <header>
                            <h2>FORM3</h2>
                    </header>
           </section>
        </div>
    </div>
                    
    <div class="row half" id="form4">
        <div class="7u" >
          <section>
                    <header>
                            <h2>FORM4</h2>
                    </header>
           </section>
        </div>
    </div>
       
       
        
                
           	<!-- /Main -->

{/block}

{block name=buttom_main}

{/block}