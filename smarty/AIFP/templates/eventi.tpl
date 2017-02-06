{extends file="generic_page.tpl"}
{block "title"}Eventi{/block}

{block name=main}  
    
        <div class="row half">
                <div class="3u">
                        <section>
                                <header>
                                        <h2>EVENTI & SAGRE</h2>
                                </header>
                                <ul class="default">
                                        <li><img src="{$root}images/pics04.jpg" width="78" height="78" alt="">
                                                <p>Nullam non wisi a sem eleifend. Donec mattis libero.</p>
                                                <span class="posted">May 9th  |  (10 )  Comments</span>
                                        </li>
                                        <li><img src="{$root}images/pics05.jpg" width="78" height="78" alt="">
                                                <p>Nullam non wisi a sem eleifend. Donec mattis libero.</p>
                                                <span class="posted">May 1st  |  (10 )  Comments</span>
                                        </li>
                                        <li><img src="{$root}images/pics06.jpg" width="78" height="78" alt="">
                                                <p>Nullam non wisi a sem eleifend. Donec mattis libero.</p>
                                                <span class="posted">April 28th  |  (10 )  Comments</span>
                                        </li>
                                </ul>
                        </section>
                </div>
                <div class="3u">
                        <section>
                                <header>
                                        <h2>CORSI</h2>
                                </header>
                                <ul class="default">
                                        <li><img src="{$root}images/pics07.jpg" width="78" height="78" alt="">
                                                <p>Nullam non wisi a sem eleifend. Donec mattis libero.</p>
                                                <span class="posted">May 9th  |  (10 )  Comments</span>
                                        </li>
                                        <li><img src="{$root}images/pics08.jpg" width="78" height="78" alt="">
                                                <p>Nullam non wisi a sem eleifend. Donec mattis libero.</p>
                                                <span class="posted">May 1st  |  (10 )  Comments</span>
                                        </li>
                                        <li><img src="{$root}images/pics09.jpg" width="78" height="78" alt="">
                                                <p>Nullam non wisi a sem eleifend. Donec mattis libero.</p>
                                                <span class="posted">April 28th  |  (10 )  Comments</span>
                                        </li>
                                </ul>
                        </section>
                </div>
                <div class="6u">
                        <section>
                                <header>
                                        <h2>NEWS</h2>
                                </header>
                                <div class="slideshow-container"> 
                                        <div class="mySlides fade" style="display: block;">
                                                <div class="numbertext">1 / 3</div>
                                                <a href="#" class="image full"><img src="{$root}images/pics10.jpg" alt=""></a>
                                                <p><b>TITOLO 1</b>
                                                        sottotitolo</P>

                                        </div>
                                        <div class="mySlides fade">
                                                <div class="numbertext">2 / 3</div>
                                                <a href="#" class="image full"><img src="{$root}images/pics10_1.jpg" alt=""></a>
                                                <p><b>TITOLO 2</b>
                                                        sottotitolo</P>

                                        </div>
                                        <div class="mySlides fade">
                                                <div class="numbertext">3 / 3</div>
                                                <a href="#" class="image full"><img src="{$root}images/pics10_2.jpg" alt=""></a>
                                                <p><b>TITOLO 3</b>
                                                        sottotitolo</P>

                                        </div>
                                        <a class="prev" onclick="plusSlides(-1)">❮</a>
                                        <a class="next" onclick="plusSlides(1)">❯</a>
                                </div>
                                <br>

                                <div style="text-align:center">
                                  <span class="dot" onclick="currentSlide(1)"></span> 
                                  <span class="dot" onclick="currentSlide(2)"></span> 
                                  <span class="dot" onclick="currentSlide(3)"></span> 
                                </div>
                        </section>
                </div>
        </div>

{/block}