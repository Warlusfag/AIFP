<?php
/* Smarty version 3.1.30, created on 2017-01-06 23:01:54
  from "/srv/www/AIFP/smarty/AIFP/templates/funghi.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_587013d25b9fb2_47929456',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a478b78fad8922bb2c24a97a8484b9a52eacc775' => 
    array (
      0 => '/srv/www/AIFP/smarty/AIFP/templates/funghi.tpl',
      1 => 1483485457,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:smarty/AIFP/templates/generic_page.tpl' => 1,
  ),
),false)) {
function content_587013d25b9fb2_47929456 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
$_smarty_tpl->compiled->nocache_hash = '1581689976587013d258f807_84305744';
?>

	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_278989100587013d25b92a6_06182378', 'main');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:smarty/AIFP/templates/generic_page.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'main'} */
class Block_278989100587013d25b92a6_06182378 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
  
	<!-- Main -->
		<div id="main">
		
			<div class="container">
				<div id="banner"></div>
			</div>
			
			<div class="container">
				<div class="row">
					<div id="sidebar" class="3u">
						<section>
							<header>
								<h2>GABRI GAY</h2>
							</header>
							<p>Questa left-sidebar la possiamo sfruttare in qualche modo?? dal punto di vista estetico non dispiace.</p>
							<ul class="style1">
								<li><a href="#">Vestibulum luctus venenatis dui</a></li>
								<li><a href="#">Integer rutrum nisl in mi</a></li>
								<li><a href="#">Etiam malesuada rutrum enim</a></li>
								<li><a href="#">Aenean elementum facilisis ligula</a></li>
								<li><a href="#">Ut tincidunt elit vitae augue</a></li>
								<li><a href="#">Sed quis odio sagittis leo vehicula</a></li>
							</ul>
						</section>
						<section>
							<header>
								<h2>Sagittis convallis</h2>
							</header>
							<p>Quisque dictum. Integer nisl risus, sagittis convallis elementum.</p>
							<ul class="style1">
								<li><a href="#">Vestibulum luctus venenatis dui</a></li>
								<li><a href="#">Integer rutrum nisl in mi</a></li>
								<li><a href="#">Etiam malesuada rutrum enim</a></li>
								<li><a href="#">Aenean elementum facilisis ligula</a></li>
								<li><a href="#">Ut tincidunt elit vitae augue</a></li>
								<li><a href="#">Sed quis odio sagittis leo vehicula</a></li>
							</ul>
						</section>
					</div>
					
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
										<a href="storia.php" class="image full"><img src="../images/pics01.jpg" alt=""></a>
										<p>La micologia e le sue scoperte scientifiche </p>
										<a href="storia.php" class="button">STORIA</a>
									</section>
								</div>
								<div class="4u">
									<section>
										<a href="schede.php" class="image full"><img src="../images/pics02.jpg" alt=""></a>
										<p>Schede di tutti i fottuti funghi allucinogeni e non</p>
										<a href="schede.php" class="button">SCHEDE</a>
									</section>
								</div>
								<div class="4u">
									<section>
										<a href="libri.php" class="image full"><img src="../images/pics03.jpg" alt=""></a>
										<p>Libri consigliati dal nostro esperto, dott.Faggioni</p>
										<a href="libri.php" class="button">LIBRI</a>
									</section>
								</div>

							</div>
						</section>
					</div>
					
				</div>
			</div>
		</div>
	<!-- /Main -->
<?php
}
}
/* {/block 'main'} */
}
