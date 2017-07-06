<div id="fb-root"></div>
<script>
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=374293735975654";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

<div class="fb-like" data-href="http://facebook.com/devhuayraoficial" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>

<script type="text/javascript">
	window.fbAsyncInit = function() {
		FB.Event.subscribe('edge.create',
			function(response) {
			alert('Le diste like a: ' + response);
			}
		);
	};
</script>