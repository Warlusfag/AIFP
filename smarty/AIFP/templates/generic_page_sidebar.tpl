{extends file="generic_page_news.tpl"}
{assign	"root" "/AIFP/"}

	{block name=sidebar}  


   
                    <div id="sidebar" class="3u">
                    <section>
                    <header>
                            <h2>AIFP</h2>
                    </header>
                        
                    <ul class="style1">
                            <li><a href="#">Clicca mi piace</a></li>
                            <li><a href="#">Follow us</a></li>
                            <li><a href="#">Instagram</a></li>
                            <li><a href="#">Lindedim Faggioni</a></li>
                            <li><a href="#">Linkedim Troiano</a></li>
                           
                    </ul>
                    </section>
                        <section>
                        <header>
                            <h2>Cerca</h2>
                        </header>
                        <form method="POST" action="search.php">
                            <input type="text" name="search" placeholder="Cerca...">
                            <button class="button" type="submit">Cerca</button>
                        </form>
                    </section>
                        {if $user==null}
                    <section>
                    <header>
                            <h2>Login</h2>
                    </header>
                 
                    <p>Esegui l'accesso per utilizzare al meglio AIFP.it </p>
                    <form method="POST" action="login.php">
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password" required>
                         <button class="loginbtn" type="submit"> Login </button>
                    </form>
                        {else}
                         <section>
                            <header>
                                    <h2>Profilo di {$user}</h2>
                            </header>
                        <!--    <img a="avatar.jpg">-->
                        <ul>
                            <li>Ultimo accesso: {$data_ua}</li>
                            <li>Tipologia: {$tipologia}</a></li>
                            <li>Numero post {$num_p}<a href="#">Etiam malesuada rutrum enim</a></li>
                        </ul>
                            <button class="loginbtn" href="{$root}/personal_page/personal_page.php"> Visita profilo </button>
                        </section>
                        {/if}
                    </div>
       
{/block}            

