{extends file="generic_page_sidebar.tpl"}

{block "title"}Lettera esperto{/block}

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

					
<div id="content" class="9u skel-cell-important">
        <section>
                <header>
                        <h2>Chiedi all'esperto</h2>
                </header>
            <a href="#" class="image full"><img src="{$root}images/pics10.jpg" alt=""></a><br>
                <form method='post' action='{$root}lettera_esperto.php'>
                    <label><b>Inserire email e nome, un esperto le risponderà il prima possibile!</b></label><br><br>   
                    <label>E-Mail</label><br>
                    <input type="email" placeholder="Inserisci Email" name="email" required><br><br>
                    <label>Nome</label><br>
                    <input type="text" placeholder="Inserisci Nome" name="nome" required><br><br>
                    <label>Testo</label><br>
                    <textarea rows='6' cols='77' placeholder="Inserisci Testo" name="testo" required></textarea><br>
                   
                    <button type="submit" class="button">Invia</button>
                </form>
        </section>
</div>
		
	<!-- /Main -->
{/block}
	