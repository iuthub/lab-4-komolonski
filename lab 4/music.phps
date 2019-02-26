<!DOCTYPE html>
<html>
	<!--
	Web Programming Step by Step
	Lab #3, PHP
	-->
	
	<?php
	$song_count = 5678;
	$news_pages = 5;
	if (isset($_GET["newspages"])) {
		$news_pages = (int) $_GET["newspages"];
	}
	?>

	<head>
		<title>Music Viewer</title>
		<meta charset="utf-8" />
		<link href="http://www.cs.washington.edu/education/courses/cse190m/12sp/labs/3/viewer.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<h1>My Music Page</h1>
		
		<!-- Exercise 1: Number of Songs (Variables) -->
		<p>
			I love music.
			I have <?= $song_count ?> total songs,
			which is over <?= (int) $song_count / 10 ?> hours of music!
		</p>

		<!-- Exercise 2: Top Music News (Loops) -->
		<!-- Exercise 3: Query Variable -->
		<div class="section">
			<h2>Yahoo! Top Music News</h2>
		
			<ol>
				<?php for ($i = 1; $i <= $news_pages; $i++) { ?>
					<li><a href="http://music.yahoo.com/news/archive/?page=<?= $i ?>">Page <?= $i ?></a></li>
				<?php } ?>
			</ol>
		</div>

		<!-- Exercise 4: Favorite Artists (Arrays) -->
		<!-- Exercise 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>
		
			<ol>
				<?php
				foreach (file("favorite.txt", FILE_IGNORE_NEW_LINES) as $artist) {
					$artist_link = implode("-", explode(" ", strtolower($artist)));
					?>
					
					<li>
						<a href="http://music.yahoo.com/videos/<?= $artist_link ?>/"><?= $artist ?></a>
					</li>
					
					<?php
				}
				?>
			</ol>
		</div>
		
		<!-- Exercise 6: Music (Multiple Files) -->
		<!-- Exercise 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
				<?php foreach (glob("/var/www/html/songs/*.mp3") as $song) { ?>
					<li class="mp3item">
						<a href="http://webster.cs.washington.edu/songs/<?= $song ?>">
							<?= basename($song) ?>
						</a>
						(<?= (int) (filesize($song) / 1024) ?> KB)
					</li>
				<?php } ?>

				<!-- Exercise 8: Playlists (Files) -->
				<?php foreach (glob("/var/www/html/songs/*.m3u") as $playlist) { ?>
					<li class="playlistitem">
						<?= basename($playlist) ?>:
						<ul>
							<?php
							foreach (file($playlist, FILE_IGNORE_NEW_LINES) as $line) {
								if (strpos($line, "#") === FALSE) {
									?>
									<li> <?= $line ?> </li>
									<?php 
								}
							}
							?>
						</ul>
					</li>
				<?php } ?>
			</ul>
		</div>
		
		<div>
			<a href="https://webster.cs.washington.edu/validate-html.php">
				<img src="http://webster.cs.washington.edu/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="https://webster.cs.washington.edu/validate-css.php">
				<img src="http://webster.cs.washington.edu/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
