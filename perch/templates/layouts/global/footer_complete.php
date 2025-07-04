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
				<img src="/assets/images/champions-24.png" alt="" style="width:100px;height:auto;"/>
			</div>
			<div class="column lightwidget flow">
				<h3>Instagram</h3>
				<!-- LightWidget WIDGET --><script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script><iframe src="https://cdn.lightwidget.com/widgets/be3a583a7c8d5345b0b8d0bddbdd7d83.html" class="lightwidget-widget" style="width:100%;border:0;overflow:hidden;"></iframe>
			</div>
			<div class="column flow">
				<h3>Get in Touch</h3>
				<p>07703 457229 &bull; <a href="mailto:info@baytownholidaycottages.co.uk">Email</a></p>
				<h3>Social Media</h3>
				<p><a href="https://www.facebook.com/Baytowncottages/" target="_blank"><i class="fa fa-2x fa-facebook"></i></a> <a href="https://twitter.com/baytowncottages" target="_blank"><i class="fa fa-2x fa-twitter"></i></a></p>
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
	
	<script src="https://platform-api.sharethis.com/js/sharethis.js#property=5f61d2ebddcc360019c41d92&product=inline-share-buttons" async="async"></script>
	<script src="https://malsup.github.io/min/jquery.cycle2.min.js"></script>
	<script src="/assets/galleria/galleria-1.4.2.min.js"></script>
	<script>
		$(document).ready(function(){
			$('.reviews').cycle({
		    	speed: 600,
		    	slides: '.quote',
		    	timeout: 6000
			});
			
			$('.tab').hide();
			$('.tab.about').show();
			
			$('.tabs ul.tab-control li a').click(function(){
				var tab = $(this).attr('title');
				$('.tabs .tab').hide();
				$('.tab.'+tab).show();
				$('.tabs ul.tab-control li').removeClass('active');
				$(this).parent().addClass('active');
			});
			if($(window).width()<741){
				$('nav ul').hide();
				$('nav a.menu').click(function(){
					$('nav ul').toggle();
				});
			}
		});
		
		function enquiry(){
			$('.tabs .tab').hide();
			$('.tab.enquiry').show();
			$('.tabs ul.tab-control li').removeClass('active');
			$('.tabs ul.tab-control li.enquiry').addClass('active');
			$('html, body').animate({
		        scrollTop: $("#enquiry").offset().top
		    }, 1000);
		}
		
		var width = $(window).width(), height = $(window).height();
		
		if($(window).width() != width && $(window).height() != height){
			$(window).resize(function(){
				if($(window).width()<741){
					$('nav ul').hide();
				}else{
					$('nav ul').show();
					$('nav ul li ul').hide();
				}
			});
		}

		if($('.display').length){
		    Galleria.loadTheme('/assets/galleria/themes/azur/galleria.azur.min.js');
		    Galleria.run('.display', {
			    transition: 'fade',
			    imageCrop: false,
			    thumbCrop: true,
			    variation: 'light'
			});
	    }
	</script>
	<script src="//downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script>
	<script>require(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us17.list-manage.com","uuid":"564182760866e50cfae046652","lid":"3e15734937"}) })</script>
  
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-351R1CN4V6"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	
	  gtag('config', 'G-351R1CN4V6');
	</script>

</body>
</html>