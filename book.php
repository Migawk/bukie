<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "./layouts/head.php"; ?>
	<?php
	$db = new DB();
	$pagesAction = new Pages();
	$booksAction = new Books();
	$libsAction = new Libs();


	$bookInfo;
	parse_str($_SERVER["QUERY_STRING"], $bookInfo);

	$book = $booksAction->getBook($bookInfo["id"]);


	if (isset($_GET["page"])) {
		$pageNum = $_GET["page"];
	} else {
		$books = $libsAction->getLib($_SESSION["user"]["id"]);
		$index = array_search($_GET["id"], array_column($books, "bookId"));

		["progress" => $progress, "bookPages" => $pagesIsRead] = $books[$index];

		$pageNum = $progress * $pagesIsRead;
	}
	$pages = $pagesAction->getPages($bookInfo["id"], $pageNum);

	?>
	<title>Bukie | <?php echo $book["name"] ?></title>
</head>

<script>
	async function setProgress(bookId, progress) {
		fetch("/api/lib.php/status/", {
			"method": "PUT",
			body: JSON.stringify({
				bookId,
				progress
			}),
			headers: {
				"Content-Type": "application/json"
			}
		}).then(res => res.text()).then(console.log);
	}
</script>

<body>
	<?php echo $twig->render("header.twig", ["user" => $_SESSION["user"], "location" => $_SERVER["PHP_SELF"]]); ?>
	<main class="d-flex px-5 py-3 gap-3">
		<aside class="d-flex flex-column gap-3">
			<div class="d-flex flex-column gap-2 p-3 color-standard bg-lighted rounded">
				<h3 class="fw-bold">Jump to page</h3>
				<form class="d-flex gap-2" method="get">
					<div class="d-flex bg-dark rounded" style="width: 100%">
						<button onclick="decr()" type="button" class="btn rounded-start btn-dark">
							&lt;
						</button>
						<input pattern="[0-9]" type="text" class="counter" style="width: 100%" value="<?= $pageNum ?>" id="pageNum">
						<button onclick="incr()" type="button" class="btn rounded-end text-lighted btn-dark">&gt;</button>
					</div>
				</form>
				<div class="d-flex gap-2">
					<a href="<?= $_SERVER["PHP_SELF"] . "?id=" . $_GET["id"] . "&page=0" ?>" class="w-100 btn btn-success">Begin</a>
					<a href="<?= $_SERVER["PHP_SELF"] . "?id=" . $_GET["id"] . "&page=" . sizeof($pages) ?>" class="w-100 btn bg-purple text-lighted">End</a>
				</div>
				<script>
					const page = document.getElementById("pageNum");
					const pagesLen = <?= sizeof($pages) ?>;
					let dirty = false;
					let ind = null;

					if (isNaN(page.value)) page.value = "0";

					function countDownChange() {
						if (isNaN(page.value)) return page.value = "0";
						if (dirty) {
							dirty = false;

							clearTimeout(ind);
							countDownChange();

							return;
						};
						dirty = true;
						
						ind = setTimeout(() => {
							const newUrl = new URL(window.location.href);
							const params = new URLSearchParams({
								id: newUrl.searchParams.get("id"),
								page: page.value
							});
							newUrl.search = params.toString();

							setProgress(newUrl.searchParams.get("id"), page.value / pagesLen);

							window.location.href = newUrl;
							dirty = false;
						}, 2000);
					}

					page.addEventListener("keyup", () => {
						countDownChange();
					});
					const decr = () => {
						if (page.value < 1) return;
						page.value--;
						countDownChange();
					};
					const incr = () => {
						if (page.value > pagesLen - 1) return;
						page.value++;
						countDownChange();
					};
				</script>
			</div>
			<div class="d-flex flex-column gap-2 p-3 color-standard bg-lighted rounded">
				<h3 class="fw-bold">Navigation</h3>
				<div>
					<?php
					if (isset($book["structure"])) {
						$structure = json_decode($book["structure"], true);
						foreach ($structure as $point) {
							$url = $_SERVER["PHP_SELF"] . "?id=" . $_GET["id"] . "&page=" . $point["page"]; // new url
					?>
							<a href="<?= $url ?>" class="d-flex justify-content-between text-decoration-none
							<?php if ($pageNum === $point["page"]) {
								echo 'color-warning';
							} else {
								echo 'color-standard';
							} ?>
							">
								<p><?= $point["name"] ?></p>
								<p><?= $point["page"] ?></p>
							</a>

					<?php
						}
					} else {
						echo "<p>Unmarked :(</p>";
					}
					?>
				</div>
			</div>
			<div class="d-flex flex-column gap-2 p-3 color-standard bg-lighted rounded">
				<h3 class="fw-bold">Appearance</h3>
				<div class="d-flex gap-2">
					<div style="background: #A7ACB1; width: 24px; height: 24px" class="rounded-circle"></div>
					<div style="background: #161719; width: 24px; height: 24px" class="rounded-circle"></div>
					<div style="background: #2F1313; width: 24px; height: 24px" class="rounded-circle"></div>
					<div style="background: #17132F; width: 24px; height: 24px" class="rounded-circle"></div>
					<div style="background: #142F13; width: 24px; height: 24px" class="rounded-circle"></div>
				</div>
				<div class="d-flex justify-content-between">
					<div class="d-flex flex-column justify-content-between">
						<h6>Size</h6>
						<div class="d-flex bg-dark rounded">
							<button class="btn rounded-start btn-dark">
								&lt;
							</button>
							<input type="text" class="counter" value="16">
							<button class="btn rounded-end text-lighted btn-dark">&gt;</button>
						</div>
					</div>
					<div class="d-flex flex-column justify-content-between">
						<h6>Font</h6>
						<button class="d-flex align-items-center pop" style="height: 38px; background: none; border: none;">
							<div>
								<svg width="14" height="8" viewBox="0 0 15 9" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M7.45151 8.27588L13.9572 1.66633C14.0658 1.55605 14.1278 1.40819 14.1303 1.25343C14.1328 1.09867 14.0757 0.948883 13.9707 0.83513L13.9636 0.827785C13.9127 0.772452 13.8511 0.728049 13.7825 0.697276C13.714 0.666503 13.6398 0.650004 13.5647 0.648783C13.4895 0.647562 13.4149 0.661645 13.3453 0.690173C13.2758 0.718702 13.2128 0.76108 13.1601 0.814731L7.03421 7.03884L1.11612 0.619071C1.06524 0.563738 1.00363 0.519335 0.935047 0.488563C0.866463 0.45779 0.792336 0.441291 0.717174 0.44007C0.642013 0.438849 0.567389 0.452931 0.497842 0.48146C0.428294 0.509989 0.365277 0.552367 0.312625 0.606018L0.305279 0.613129C0.196674 0.723412 0.134686 0.871266 0.132171 1.02603C0.129657 1.18079 0.18681 1.33058 0.291776 1.44433L6.57935 8.26171C6.63465 8.32166 6.70154 8.36977 6.77598 8.4031C6.85042 8.43644 6.93085 8.45431 7.0124 8.45563C7.09395 8.45696 7.17492 8.44171 7.2504 8.41081C7.32588 8.37991 7.3943 8.33401 7.45151 8.27588Z" fill="#161719" />
								</svg>
							</div>
							<div>Ubuntu</div>
						</button>
						<div class="d-flex flex-column color-standard bg-standart rounded popList">
							<button class="p-2 rounded-top">Inter</button>
							<button class="p-2">Roboto</button>
							<button class="p-2">Lato</button>
							<button class="p-2 rounded-bottom">Droid Sans</button>
						</div>
					</div>
				</div>
			</div>
		</aside>
		<article class="w-100 d-flex flex-column gap-3">
			<?php
			if (sizeof($pages) > 0) {
				foreach ($pages as $page) { ?>
					<div class="p-3 color-standard bg-lighted rounded d-flex flex-column justify-content-between" style="min-height: 384px">
						<div class="content"><?php print_r($page["content"]); ?></div>
						<p class="number text-end fw-bold">
							<?php
							if ($page["number"] != 0) {
								echo $page["number"];
							} else {
								echo "Title page";
							}
							?>
						</p>
					</div>
				<?php }
			} else { ?>
				<div class="p-3 color-standard bg-lighted rounded d-flex flex-column justify-content-between" style="min-height: 384px">
					<h2>An empty page.</h2>
				</div>
			<?php
			}
			?>
		</article>
	</main>
	<?php echo $twig->render("footer.twig"); ?>

</body>

</html>