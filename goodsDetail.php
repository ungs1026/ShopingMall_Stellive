<!DOCTYPE html>
<html lang="ko">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Goods Detail Page</title>

	<!--Google Fonts - 나눔고딕-->
	<link rel="preconnect" href="https://fonts.gstatic.com" />
	<link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700&display=swap" rel="stylesheet" />
	<!--Google Material Icons-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

	<!--GSAP & ScrollToPlugin-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/ScrollToPlugin.min.js" integrity="sha512-nTHzMQK7lwWt8nL4KF6DhwLHluv6dVq/hNnj2PBN0xMl2KaMm1PM02csx57mmToPAodHmPsipoERRNn4pG7f+Q==" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="./css/style.css">
	<script defer src="./js/script.js"></script>
</head>

<body>
	<?php include 'nav.php'; ?>
	<main>
		<section class="content-wrapper">
			<div class="goods-content">
				<?php
				include 'includes/goodsDBconfig.php';
				include 'includes/getData.php';
				$id = (isset($_GET['id']) && $_GET['id'] != '' && is_numeric($_GET['id'])) ? $_GET['id'] : '';

				$item = getData($pdo, $id); // name / img / price / proudction / sales / date

				$s_rs = '';
				if (!empty($item['production'])) {
					if ($item['production'] == 'A') {
						$s_rs = 'KEYCAP';
					} elseif ($item['production'] == 'B') {
						$s_rs = 'Stellive Membership';
					} elseif ($item['production'] == 'C') {
						$s_rs = 'Universe Acrylic Stand';
					} elseif ($item['production'] == 'D') {
						$s_rs = 'Tabi Birthday Goods';
					} elseif ($item['production'] == 'E') {
						$s_rs = 'Nana Birthday Goods';
					}
				}
				?>
				<img src="<?= $item['img'] ?>" alt="">
				<div class="item-detail">
					<span class="title"><?= strtoupper($item['name']); ?></span><br>
					<span><img src="./source/icons/date_icon.png" alt="date">Date : <?= $item['date'] ?></span><br>
					<span><img src="./source/icons/goods_icon.png" alt="date">Production : <?= $s_rs ?></span><br>
					<span><img src="./source/icons/price_icon.png" alt="date">Price : <?= $item['price'] ?>\</span>
				</div>
			</div>

			<div class="item-detail">
				<div class="btn-group">
					<button class="button button--wayra button--border-thick button--text-upper button--size-s"><a href="#detail-img">상세보기</a></button>
					<button class="button button--wayra button--border-thick button--text-upper button--size-s"><a href="#delivery">배송정보</a></button>
					<button class="button button--wayra button--border-thick button--text-upper button--size-s"><a href="#return">반품/교환 정보</a></button>
				</div>

				<div class="detail-img" id="detail-img">
					<img src="<?= $item['detailImg'] ?>" alt="null">
				</div>

				<div class="delivery" id="delivery">

					<div class="deliv-info">
						<h2>배송 정보</h2>
						<ul>
							배송 안내
							<li>파손 또는 하자가 있는 창작물을 수령한 이후 7일 이내로 교환이 가능합니다. 교환 및 AS 문의는 '팬<br>
								딩 고객센터'로 문의해 주세요</li>
							<li>파손이나 불량품 교환 시 발생하는 비용은 크리에이터가 부담합니다. (단, 창작물의 실물 확인을 위<br>
								한 포장 훼손 외에 아이템의 가치가 훼손된 경우에는 교환 및 환불이 불가합니다.)</li>
							<li>유저가 배송지를 잘못 기재하여 배송사고가 발생할 경우 배송비 부담은 유저에게 있습니다.</li>
						</ul>
						<ul>
							배송 방법
							<li>택배</li>
						</ul>
						<ul>
							배송 지역
							<li>전국 지역 및 배송 가능 해외 지역</li>
						</ul>
						<ul>
							배송 비용
							<li>국내 도서 산간 지역 또는 해외 지역은 추가 배송비가 발생할 수 있습니다. 정확한 배송비는 배송지<br>
								입력을 완료한 후 주문 및 결제 화면에서 확인하실 수 있습니다.</li>
						</ul>
					</div>

				</div>

				<div class="return" id="return">
					<div class="return-detail">
						<h2>반품/교환 정보</h2>
						<ul>
							반품/교환 방법
							<li>My > 주문내역 > 주문 > 상세 통해 반품/교환 신청 또는 FAQ 확인</li>
						</ul>
						<ul>
							반품/교환 가능 기간
							<li>구매자는 상품을 수령한 날부터 7일 이내에 교환/반품 신청을 하여야 하며,표시·광고 내용과 다르거<br>
								나 계약 내용과 다르게 이행된 경우에는 상품 수령 후 3개월 이내에 청약 철회가 가능합니다.</li>
							<li>(단, 변심의 경우 교환은 불가하며, 반품만 가능합니다.)</li>
						</ul>
						<ul>
							반품/교환 비용
							<li>구매자의 변심으로 반품을 원할 경우에는 구매자가 배송비 지불</li>
							<li>상품 하자나 제품 불일치, 배송 이슈로 인한 반품의 경우에는 판매자가 배송비 지불</li>
						</ul>
						<ul>
							반품/교환시 유의사항
							<li>변심 반품 접수 시, 상품 포장 개봉 상태의 경우 반품접수 불가합니다.</li>
							<li>상품 착용의 흔적이 있거나, 라벨 및 텍 제거, 상품 박스 및 포장 제거 등으로 새 상품으로서의 가치<br>
								가 감소한 경우 반품접수 불가합니다.</li>
							<li>교환은 불량일 경우에만 동일한 상품 및 동일한 옵션에 한하여 가능합니다. 이 외에 경우에는 반품<br>
								후 재구매절차를 진행하셔야 합니다.</li>
							<li>교환신청을 하더라도 판매자에게 교환할 물품의 재고가 없는 경우에는 교환이 불가능하며, 이 경우<br>
								에 해당 상품의 주문을 취소처리 후, 결제시 선택했던 결제 수단으로 환불처리 됩니다.</li>
						</ul>
						<ul>
							소비자 피해 보상 및 환불지연에 따른 배상
							<li>상품의 불량에 의한 반품, 교환, A/S, 환불 , 품질보증 및 피해보상 등에 관한 사항은 소비자분쟁해결<br>
								기준(공정거래위원회 고시)에 준하여 처리됨.</li>
							<li>대금 환불 및 환불 지연에 따른 배상금 지급 조건, 절차 등은 전자상거래 등에서의 소비자 보호에 관<br>
								한 법률에 따라 처리함.</li>
							<li>분실 혹은 반송의 경우, 국내 배송 건은 출고일 기준 1달 이내, 해외 배송건은 출고일 기준 4달 이내<br>
								로 고객센터를 통해 문의 접수가 필요함. 해당 기간을 넘긴 건들은 각 배송사의 정책으로 인해, 보상<br>
								이 어려움.
							</li>
							<li>(단, DHL 배송사를 통한 문 앞 배송의 경우, 출고일 기준 30일 이내 접수시 클레임 진행이 가능하며<br>
								해당 기간 경과 시 대응이 불가 할 수 있음)</li>
						</ul>
						<ul>
							기타
							<li>일부 규정은 국내구매자 분들께만 해당되며, 해외구매자 분들을 위한 상세 안내는 FAQ 혹은 1:1 문<br>
								의를 통해 확인해주세요.</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
	</main>

	<!--TO TOP BUTTON-->
	<div id="to-top">
		<div class="material-icons">arrow_upward</div>
	</div>

	<script>
		const toTop = document.querySelector('#to-top');

		toTop.addEventListener('click', function() {
			gsap.to(window, .2, {
				scrollTo: 0
			})
		})
	</script>
</body>

</html>