<!--nav-->
<header>
	<nav>
		<div class="nav-left">
			<a href="index.php"><img src="./source/img/logo_name.png" alt="Logo" class="logo"></a>
		</div>
		<div class="nav-center">
			<a href="index.php">GOODS</a>
			<a href="board.php?page=1&code=freeboard">COMUNITY</a>
		</div>
		<div class="nav-right">
			<a href="#"><img src="source/icons/cart.png" alt="cart" class="cart-icon"></a>
			<a href="#login" class="login-button">LOGIN</a>
		</div>
	</nav>

	<div class="nav-separator"></div>
</header>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		window.addEventListener('scroll', () => {
			if(window.scrollY > 0) {
				document.querySelector('header').classList.add('scrolled');
			} else {
				document.querySelector('header').classList.remove('scrolled');
			}
		})
	});
</script>