<!DOCTYPE html>
<html>
	<link rel="stylesheet" href="jquery.fancybox-1.3.4.css" type="text/css">
	<script type='text/javascript' src='jquery.min.js'></script>
	<script type='text/javascript' src='jquery.fancybox-1.3.4.pack.js'></script>
	<script type="text/javascript">
		$(function() {
			$("a.group").fancybox({
				'nextEffect'	:	'fade',
				'prevEffect'	:	'fade',
				'overlayOpacity' :  0.8,
				'overlayColor' : '#000000',
				'arrows' : false,
			});		
		});
	</script>
<!-- https://www.instagram.com/oauth/authorize/?client_id=8a6c055610a741ef8d22a6f28bceb79d&redirect_uri=http://localhost&response_type=token&scope=public_content -->
	<?php
		// Supply a user id and an access token
		$userid = "208330322";
		$accessToken = "208330322.e029fea.d13be181131f426d95b1f2fcac280110";
		$locationid = "1661530050836404";

		// Gets our data
		function fetchData($url){
		     $ch = curl_init();
		     curl_setopt($ch, CURLOPT_URL, $url);
		     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		     curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		     $result = curl_exec($ch);
		     curl_close($ch); 
		     return $result;
		}

		// Pulls and parses data.
		// $result = fetchData("https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}");
		$result = fetchData("https://api.instagram.com/v1/locations/1661530050836404/media/recent?access_token=208330322.e029fea.d13be181131f426d95b1f2fcac280110&count=100");
		$result = json_decode($result);
	?>
 	<?php print_r($result->pagination->next_url)  ?>

	<?php foreach ($result->data as $post): ?>
		<!-- Renders images. @Options (thumbnail,low_resoulution, high_resolution) -->
		<a class="group" rel="group1" href="<?= $post->images->standard_resolution->url ?>" data-id="<?= $post->caption->from->id ?>"><img src="<?= $post->images->thumbnail->url ?>"></a>
	<?php endforeach ?>
</html>