{extends file="generic_page_news.tpl"}


{block name=sidebar}  
    <div id="sidebar" class="3u">

            {block name=mainside}
                
            {/block}
                        
                        
        {block name=userside}
             {if !$profilo.user}
            <section>

            <header>
                    <h2>Login</h2>
            </header>

            <p>Esegui l'accesso per utilizzare al meglio AIFP.it </p>
            <form method="POST" action="{$root}login.php">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                 <button class="loginbtn" type="submit"> Login </button>
            </form>
                {else}
                 <section>
                    <header>
                            <h2>Profilo di {$profilo.user}</h2>
                    </header>
                <!--    <img a="avatar.jpg">-->
                <ul>
                    <li><img src="{$root}{$profilo.image}" class="pic"></li>
                    <li>Tipologia: {$profilo.type}</li>
                    <li>Punteggio: {$profilo.punteggio}</li>
                    <li>Numero post: {$profilo.num_post}</li>
                </ul>
                    <form action="{$root}personal_page/personal_page.php">
                    <button class="button">Visita profilo </button></form>
                </section>
                {/if}
                </section>

        {/block}
        </div>
       
{/block}            

