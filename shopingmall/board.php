<!DOCTYPE html>
<html lang="ko">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Freeboard Page</title>

	<link rel="stylesheet" href="./css/style.css">
	<script defer src="./js/script.js"></script>
</head>

<body>
	<?php include 'nav.php'; ?>
	<main>
		<section class="content-wrapper">
			<?php
			include 'includes/freeboard/boardconfig.php';
			include 'includes/goodsDBconfig.php';
			include 'includes/freeboard/lib.php';


			$sn   = (isset($_GET['sn']) && $_GET['sn'] != '') ? $_GET['sn'] : '';
			$sf   = (isset($_GET['sf']) && $_GET['sf'] != '') ? $_GET['sf'] : '';
			$code = (isset($_GET['code']) && $_GET['code'] != '') ? $_GET['code'] : '';

			if ($code == '') {
				die('코드가 누락되었습니다.');
			}

			$where = "WHERE code='" . $code . "'";

			if ($sn != '' && $sf != '') {
				switch ($sn) {
					case 1:
						$where .= " AND (subject LIKE '%" . $sf . "%' OR content LIKE '%" . $sf . "%' )";
						break; // 제목 + 내용
					case 2:
						$where .= " AND (subject LIKE '%" . $sf . "%')";
						break; // 제목
					case 3:
						$where .= " AND (content LIKE '%" . $sf . "%')";
						break; // 내용
					case 4:
						$where .= " AND (name = '" . $sf . "')";
						break; // 이름
				}
			}

			$limit = 5;
			$page_limit = 5;

			$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
			$start = ($page - 1) * $limit;

			$sql = "SELECT COUNT(*) cnt FROM freeboard " . $where;
			$stmt = $pdo->prepare($sql);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();
			$row = $stmt->fetch();
			$total = $row['cnt'];


			$sql = "SELECT * FROM freeboard " . $where . " ORDER BY idx DESC LIMIT $start, $limit";
			$stmt = $pdo->prepare($sql);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();
			$rs = $stmt->fetchAll();
			?>

			<div class="notice-container">
				<h1>
					<?= $board_title ?>
				</h1>
			</div>
			<div class="table-container">
				<div class="table-content">
					<table class="notice-table">
						<colgroup>
							<col width="10%" />
							<col width="50%" />
							<col width="14%" />
							<col width="13%" />
							<col width="13%" />
						</colgroup>
						<thead>
							<tr>
								<th>번호</th>
								<th>제목</th>
								<th>글쓴이</th>
								<th>등록일</th>
								<th>조회수</th>
							</tr>
						</thead>
						<?php
						foreach ($rs as $row) {
						?>
							<tr class="view_detail" data-idx="<?= $row['idx']; ?>" data-code="<?= $code; ?>">
								<td>
									<?= $row['idx']; ?>
								</td>
								<td class="text-content">
									&nbsp;&nbsp;&nbsp;&nbsp;<?= $row['subject']; ?>
								</td>
								<td>
									<?= $row['name']; ?>
								</td>
								<td>
									<?= substr($row['rdate'], 0, 10); ?>
								</td>
								<td>
									<?= $row['hit']; ?>
							</tr>
						<?php } ?>
				</div>
				</table>


				<div class="contant-container">
					<select class="form-select" id="sn">
						<option value="1" <?= ($sn == 1) ? ' selected' : ''; ?>>제목+내용</option>
						<option value="2" <?= ($sn == 2) ? ' selected' : ''; ?>>제목</option>
						<option value="3" <?= ($sn == 3) ? ' selected' : ''; ?>>내용</option>
						<option value="4" <?= ($sn == 4) ? ' selected' : ''; ?>>글쓴이</option>
					</select>
					<input type="text" class="form-control" id="sf" value="<?= $sf ?>">
					<button class="btn" id="btn_search">검색</button>
				</div>

				<div class="pagination-text">
					<?php
					$param = '&code=' . $code;
					if ($sn != '') {
						$param .= '&sn=' . $sn;
					}
					if ($sf != '') {
						$param .= '&sf=' . $sf;
					}

					$rs_str = my_pagination($total, $limit, $page_limit, $page, $param);
					echo $rs_str;

					?>
					<button class="btn" id="btn_wirteb">글쓰기</button>

				</div>
			</div>

			<script>
				function getUrlParams() {
					var params = {};

					window.location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,
						function(str, key, value) {
							params[key] = value;
						}
					);

					return params;
				}

				var btn_wirteb = document.querySelector("#btn_wirteb");
				btn_wirteb.addEventListener("click", () => {
					var url = './write.html?code=<?= $code; ?>';
					window.open(url, 'newWindow');
				})

				var view_detail = document.querySelectorAll(".view_detail")
				view_detail.forEach((box) => {
					box.addEventListener("click", () => {
						console.log('click');
						// self.location.href = './view.html?idx=' + box.dataset.idx + '&code=' + box.dataset.code;
						var url = './view.html?idx=' + box.dataset.idx + '&code=' + box.dataset.code;
						var res1 = encodeURI(url);
						window.open(res1 , 'newWindow');
					})
				})

				var btn_search = document.querySelector("#btn_search")
				btn_search.addEventListener("click", () => {
					var sn = document.querySelector("#sn")
					var sf = document.querySelector("#sf")
					if (sf.value == '') {
						alert('검색어를 입력해 주세요')
						sf.focus()
						return false
					}

					var params = getUrlParams()

					self.location.href = './board.php?code=' + params['code'] + '&sn=' + sn.value + '&sf=' + sf.value
				})
			</script>
		</section>
	</main>

</body>

</html>