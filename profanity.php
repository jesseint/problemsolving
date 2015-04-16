<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php include "myfunction.php"; ?>
		
	<?php
		if (isset($_POST["checking"])) {
			if ((isset($_POST["prof_words"]) && !empty($_POST["prof_words"])) && (isset($_POST["input_text"]) && !empty($_POST["input_text"]))) {
				$prof_words = $_POST["prof_words"];
				$input_text = $_POST["input_text"];
								
				$result = get_profanity_words($input_text, $prof_words);
				
				if (!empty($result)) {
					echo "There are some (or maybe many) profanity words in the input text<br/>";					
					foreach ($result as $r) {
						echo $r." ";
					}

				} else {
					echo "The text are CLEAR";
				}
				echo "<br/><br/><a href='profanity.php'>Go back</a>";
				echo "<br/><br/>";
				
				echo "Profanity Words:<br/><br/>";
				echo $prof_words."<br/><br/>";
	
				echo "Input Text:<br/><br/>";
				echo $input_text."<br/><br/>";
								
			} else {
				echo "Please input some valid data.";
			}
			
			echo "<a href='profanity.php'>Go back</a>";
		} else {
	?>
		<form method="POST">
		<table>
			<tr>
				<td>Please input profanity words here (separated with space)</td>
				<td>Please input the text here</td>
			</tr>
			<tr>
				<td>
					<textarea name="prof_words" rows="30" cols="80" placeholder="Please input your profanity words here"></textarea>
				</td>
				<td>
					<textarea name="input_text" rows="30" cols="80" placeholder="Please input your text here"></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="checking" value = "Check Now" />
				</td>
			</tr>
		</table>
		</form>
    
	<?php } ?>
</body>
