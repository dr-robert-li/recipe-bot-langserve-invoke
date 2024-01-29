<div id="recipe-bot-app">

	<form class="recipe-bot-form" action="#">
		<input type="text" required placeholder="<?php echo mb_get_block_field('rb-input-placeholder') ?>">

		<button type="submit">
			<?php echo empty(mb_get_block_field('rb-button-text')) ? 'Confirm' : mb_get_block_field('rb-button-text') ?>
			<span><i class="gg-loadbar-alt"></i></span>
		</button>
	</form>

	<div class="recipe-bot-render"></div>
</div>

<script>
	function empty(string) {
		return string == '' ? true : false
	}

	document.querySelector('.recipe-bot-form').addEventListener('submit', function(e) {
		e.preventDefault();

		let button = this.querySelector('button span');
		let render = document.querySelector('.recipe-bot-render');
		let user_input = this.querySelector('input').value;
		let input_ip = '<?php echo empty(mb_get_block_field('rb-endpoint')) ? 'https://api.robs.kitchen' :  mb_get_block_field('rb-endpoint') ?>';
		let system_msg = '<?php echo mb_get_block_field('rb-system_message') ?>';
		let context = '<?php echo mb_get_block_field('rb-context') ?>';

		// console.log(user_input, input_ip, system_msg, context)

		let headers = new Headers();
		headers.append("Content-Type", "application/json");

		button.style.visibility = 'visible';
		// render.style.display = 'block';

		fetch(`${input_ip}/invoke/`, {
				method: 'POST',
				headers: headers,
				body: JSON.stringify({
					"input": {
						"chat_history": [
							[
								empty(system_msg) ? "You are a world class baker" : system_msg,
								empty(context) ? "You will try to respond with a full recipe including instructions, difficulty, time to prepare and serves from the dataset and if there is not a recipe in the dataset come up with a full recipe including instructions, difficulty, time to prepare and serves and try to emulate the style as best as possible" : context
							]
						],
						"question": user_input
					},
					"config": {},
					"kwargs": {}
				}),
				// redirect: 'follow'
			})
			.then(response => response.json())
			.then(result => {
				button.style.visibility = 'hidden'; // Correct the visibility property
				render.style.display = 'block';
				render.innerHTML = result.output;
				console.log(result);
			})
			.catch(error => console.log('error', error));

	});
</script>