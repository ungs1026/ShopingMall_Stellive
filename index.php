<!DOCTYPE html>
<html lang="ko">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Goods Page</title>

	<link rel="stylesheet" href="./css/style.css">
	<script defer src="./js/script.js"></script>
</head>

<body>
	<?php include 'nav.php'; ?>
	<main>
		<section class="content-wrapper">
			<?php include './sidebar.php'; ?>

			<section class="albums-content"> <!-- 동일한 클래스 사용 -->
				<div class="main-img">
					<img src="./source/img/mystic+universe.png" alt="#">
					<iframe width="533" height="300" src="https://www.youtube.com/embed/GN-rdF8tEpU?si=Vcq8mE8Gp-62Mhn0" 
						title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
						referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
					<img src="./source/img/cliche.png" alt="#">
				</div>
				<!-- 굿즈 그리드 -->
				<div class="albums-grid"> <!-- 동일한 그리드 클래스 사용 -->
					<?php
					// 데이터베이스 연결
					include 'includes/goodsDBconfig.php';

					// 페이지네이션 포함
					$pagination = include 'pagination.php';
					$goods = $pagination['goods'];
					$totalPages = $pagination['totalPages'];
					$currentPage = $pagination['currentPage'];

					if (empty($goods)): ?>
						<div class="no-results">
							<img src="source/icons/crying.png" alt="No Results" class="no-results-image">
							<p>No results</p>
						</div>
					<?php else: ?>
						<?php foreach ($goods as $item): ?>
							<div class="album-item" data-id="<?php echo htmlspecialchars($item['id']); ?>"> <!-- 동일한 클래스 사용 -->
								<img src="<?php echo htmlspecialchars($item['img']); ?>" alt="Goods Image">
								<div class="album-name"><?php echo htmlspecialchars($item['name']); ?></div> <!-- 동일한 클래스 사용 -->
								<div class="album-price"><?php echo number_format($item['price']); ?>원</div> <!-- 동일한 클래스 사용 -->
								<div class="album-overlay">
									<a href="goodsDetail.php?id=<?= $item['id'] ?>" target="_blank">Go to Detail</a>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>

				<!-- 페이지네이션 -->
				<div class="pagination">
					<?php if ($currentPage > 1): ?>
						<a href="index.php?page=<?php echo $currentPage - 1; ?><?php echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : ''; ?><?php echo isset($_GET['production']) ? '&production=' . $_GET['production'] : ''; ?><?php echo isset($_GET['price']) ? '&price=' . $_GET['price'] : ''; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?>">&laquo; Previous</a>
					<?php endif; ?>

					<?php for ($i = 1; $i <= $totalPages; $i++): ?>
						<a href="index.php?page=<?php echo $i; ?><?php echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : ''; ?><?php echo isset($_GET['production']) ? '&production=' . $_GET['production'] : ''; ?><?php echo isset($_GET['price']) ? '&price=' . $_GET['price'] : ''; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?>" <?php echo $i == $currentPage ? 'class="active"' : ''; ?>>
							<?php echo $i; ?>
						</a>
					<?php endfor; ?>

					<?php if ($currentPage < $totalPages): ?>
						<a href="index.php?page=<?php echo $currentPage + 1; ?><?php echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : ''; ?><?php echo isset($_GET['production']) ? '&production=' . $_GET['production'] : ''; ?><?php echo isset($_GET['price']) ? '&price=' . $_GET['price'] : ''; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?>">Next &raquo;</a>
					<?php endif; ?>
				</div>
			</section>
		</section>
	</main>

</body>

</html>