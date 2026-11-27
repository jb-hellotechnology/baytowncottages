	<footer>
		<div class="restrict columns">
			<div class="column flow">
				<!-- Begin MailChimp Signup Form -->
				<h3>Subscribe to our Mailing List</h3>
				<p>Get the latest updates from Baytown Holiday Cottages in your inbox.</p>
				<div id="mc_embed_signup">
					<form action="https://baytownholidaycottages.us17.list-manage.com/subscribe/post?u=564182760866e50cfae046652&amp;id=3e15734937" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
					    <div id="mc_embed_signup_scroll">
						<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="you@example.com" required>
					    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_564182760866e50cfae046652_3e15734937" tabindex="-1" value=""></div>
					    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
					    </div>
					</form>
				</div>
				<!--End mc_embed_signup-->
			</div>
			<div class="column flow">
				<h3>Quick Links</h3>
				<ul>
					<li><a href="/">Home</a></li>
					<li><a href="/our-cottages">Accommodation</a></li>
					<li><a href="/the-local-area">Robin Hood's Bay</a></li>
					<li><a href="/news">Blog</a></li>
					<li><a href="/contact">Contact</a></li>
				</ul>
				<img src="/assets/images/champions-25.webp" alt="" style="width:100px;height:auto;"/>
			</div>
			<div class="column lightwidget flow">
				<h3>Instagram</h3>
				<!-- LightWidget WIDGET --><script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script><iframe src="https://cdn.lightwidget.com/widgets/be3a583a7c8d5345b0b8d0bddbdd7d83.html" class="lightwidget-widget" style="width:100%;border:0;overflow:hidden;" title="LightWidget Instagram Feed"></iframe>
			</div>
			<div class="column flow">
				<h3>Get in Touch</h3>
				<p>07703 457229 &bull; <a href="mailto:info@baytownholidaycottages.co.uk">Email</a></p>
				<h3>Social Media</h3>
				<ul class="social">
					<li class="inline"><a href="http://instagram.com/baytownholidaycottages" target="_blank"><i class="fa fa-instagram fa-3x"></i><span>Follow us on Instagram</span></a></li>
					<li class="inline"><a href="https://www.facebook.com/baytownholidaycottages" target="_blank"><i class="fa fa-facebook-official fa-3x"></i><span>Follow us on Facebook</span></a></li>
					<li class="inline"><a href="https://www.threads.com/@baytownholidaycottages" target="_blank"><i class="fa-brands fa-threads fa-3x"></i><span>Follow us on Threads</span></a></li>
					<li class="inline"><a href="https://www.pinterest.co.uk/baytownholidaycottages/" target="_blank"><i class="fa fa-pinterest fa-3x"></i><span>Follow us on Pinterest</span></a></li>
				</ul>
				<h3>Snail Mail</h3>
				<p class="smaller">Baytown Holiday Cottages Ltd<br>
				7, Castle Road,<br>
				Whitby,<br>
				North Yorkshire,<br>
				YO21 3NJ</p>
			</div>
		</div>
		<div class="copyright">
			<div class="restrict">
				<ul>
					<li>&copy; Baytown Holiday Cottages Ltd <?= date('Y') ?> &bull; <a href="/privacy-policy">Privacy Policy</a></li>
					<li><a href="https://hellotechnology.co.uk" title="Website Design, Development and Hosting in Whitby, North Yorkshire">Website Design Whitby</a></li>
				</ul>
			</div>
		</div>
	</footer>
	
	<script src="https://kit.fontawesome.com/b1c527b17b.js" crossorigin="anonymous"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0/dist/fancybox/fancybox.umd.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.umd.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.thumbs.umd.js"></script>
	
	<script src="//downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script>
	<script>require(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us17.list-manage.com","uuid":"564182760866e50cfae046652","lid":"3e15734937"}) })</script>
	
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-351R1CN4V6"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		
		gtag('config', 'G-351R1CN4V6');
	</script>
	
	<script>
		$(document).ready(function(){
			$('.tab').hide();
			$('.tab.about').show();
			$('.tabs ul.tab-control li a').click(function(){
				var tab = $(this).attr('title');
				$('.tabs .tab').hide();
				$('.tab.'+tab).show();
				$('.tabs ul.tab-control li').removeClass('active');
				$(this).parent().addClass('active');
			});
			
			/* ---- Main menu: slide-in panel + collapsible sub-menus ---- */
			(function(){
				var $nav = $('.navigation nav');
				if(!$nav.length) return;
				var $backdrop = $('<div class="nav-backdrop"></div>').appendTo('.navigation');
				var isMobile = function(){ return window.matchMedia('(max-width:1010px)').matches; };

				// Add a chevron toggle + animation wrapper to every item with a sub-menu
				$nav.find('li').each(function(){
					var $li = $(this);
					var $sub = $li.children('ul').first();
					if(!$sub.length) return;
					$li.addClass('has-sub');
					var $parentLink = $li.children('a').first();
					var $wrap = $('<div class="sub-wrap"></div>').insertBefore($sub).append($sub);
					var $btn = $('<button class="sub-toggle" type="button" aria-expanded="false" aria-label="Toggle sub-menu"><span class="chev"></span></button>').insertBefore($wrap);

					// Keep the parent's own page reachable from inside the sub-menu
					var href = $parentLink.attr('href');
					if(href){
						$('<li class="parent-page"><a href="'+href+'">'+$.trim($parentLink.text())+' &ndash; overview</a></li>').prependTo($sub);
					}

					function toggle(e){
						e.preventDefault();
						var open = $li.toggleClass('open').hasClass('open');
						$btn.attr('aria-expanded', open ? 'true' : 'false');
					}
					$btn.on('click', toggle);
					// On mobile, tapping the parent name reveals the sub-menu instead of navigating
					$parentLink.on('click', function(e){ if(isMobile()) toggle(e); });
				});

				function openMenu(){ $nav.addClass('show'); $backdrop.addClass('show'); $('body').addClass('nav-open'); }
				function closeMenu(){ $nav.removeClass('show'); $backdrop.removeClass('show'); $('body').removeClass('nav-open'); }

				$('.navigation button.menu').on('click', openMenu);
				$('nav button.close').on('click', closeMenu);
				$backdrop.on('click', closeMenu);
				$(document).on('keyup', function(e){ if(e.key === 'Escape') closeMenu(); });
			})();

			$('.property-search button').click(function(){
				var $btn = $(this);
				var isOpen = $btn.next('form').toggleClass('is-open').hasClass('is-open');
				$btn.toggleClass('is-open', isOpen).text(isOpen ? 'Hide Search' : 'Property Search');
			});
			
			$('ul.accordion li h3').click(function(){
				$(this).next('div div').toggleClass('active');
			});
		});
		Fancybox.bind("[data-fancybox]", {
		  // Your custom options
		});
	</script>
</body>
</html>