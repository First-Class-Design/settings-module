<?php
/**
 * Plugin Name: [FCD] Snow Flakes ❄️
 * Plugin URI: https://fcd.org.uk/services/web/
 * Description: Enables a winter overlay throughout the website.
 * Version: 1.0.2
 * Text Domain: fcd-snow
 * Author: Matt Watson
 * Author URI: https://fcd.org.uk/
 * License: Copyright 2025 - First Class Design Ltd.
 **/

// Registers the Banner inside the footer
function fcd_snow_flakes() {
	?> <div class="snow-hold">
	<?php 
	// Outputting 200 snow items efficiently
	for ( $i = 0; $i < 200; $i++ ) {
		echo '<div class="snow"></div>';
	}
	?>
</div>
	<?php
}
add_action('wp_footer', 'fcd_snow_flakes');

// Registers the CSS inside the header
add_action('wp_head', 'fcd_snow_flakes_css');
function fcd_snow_flakes_css() { 
	?>
  <style>
		.snow-hold {
		height: 100vh;
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		pointer-events: none;
		z-index: 9999999999;
		overflow: hidden;
		filter: drop-shadow(0 0 10px white);
		opacity: 0.7;
		}

		.snow {
		position: absolute;
		width: 10px;
		height: 10px;
		background: #ffffff;
		border-radius: 50%;
		}
		.snow:nth-child(1) { opacity: 0.3013; transform: translate(51.313vw, -10px) scale(0.2577); animation: fall-1 21s -23s linear infinite; }
		@keyframes fall-1 { 38.204% { transform: translate(57.6548vw, 38.204vh) scale(0.2577); } to { transform: translate(54.4839vw, 100vh) scale(0.2577); } }
		.snow:nth-child(2) { opacity: 0.3705; transform: translate(13.9897vw, -10px) scale(0.0663); animation: fall-2 12s -19s linear infinite; }
		@keyframes fall-2 { 68.907% { transform: translate(10.0109vw, 68.907vh) scale(0.0663); } to { transform: translate(12.0003vw, 100vh) scale(0.0663); } }
		.snow:nth-child(3) { opacity: 0.8548; transform: translate(72.1672vw, -10px) scale(0.834); animation: fall-3 19s -9s linear infinite; }
		@keyframes fall-3 { 34.569% { transform: translate(78.6666vw, 34.569vh) scale(0.834); } to { transform: translate(75.4169vw, 100vh) scale(0.834); } }
		.snow:nth-child(4) { opacity: 0.0417; transform: translate(64.0702vw, -10px) scale(0.6219); animation: fall-4 17s -10s linear infinite; }
		@keyframes fall-4 { 51.799% { transform: translate(68.9676vw, 51.799vh) scale(0.6219); } to { transform: translate(66.5189vw, 100vh) scale(0.6219); } }
		.snow:nth-child(5) { opacity: 0.4956; transform: translate(76.5071vw, -10px) scale(0.0691); animation: fall-5 17s -25s linear infinite; }
		@keyframes fall-5 { 43.455% { transform: translate(72.3376vw, 43.455vh) scale(0.0691); } to { transform: translate(74.42235vw, 100vh) scale(0.0691); } }
		.snow:nth-child(6) { opacity: 0.8621; transform: translate(15.7975vw, -10px) scale(0.0363); animation: fall-6 18s -3s linear infinite; }
		@keyframes fall-6 { 76.355% { transform: translate(9.7725vw, 76.355vh) scale(0.0363); } to { transform: translate(12.785vw, 100vh) scale(0.0363); } }
		.snow:nth-child(7) { opacity: 0.4379; transform: translate(74.3895vw, -10px) scale(0.1444); animation: fall-7 21s -9s linear infinite; }
		@keyframes fall-7 { 70.455% { transform: translate(76.5699vw, 70.455vh) scale(0.1444); } to { transform: translate(75.4797vw, 100vh) scale(0.1444); } }
		.snow:nth-child(8) { opacity: 0.2911; transform: translate(91.0018vw, -10px) scale(0.1533); animation: fall-8 23s -1s linear infinite; }
		@keyframes fall-8 { 53.188% { transform: translate(91.9293vw, 53.188vh) scale(0.1533); } to { transform: translate(91.46555vw, 100vh) scale(0.1533); } }
		.snow:nth-child(9) { opacity: 0.3728; transform: translate(51.9789vw, -10px) scale(0.5579); animation: fall-9 15s -14s linear infinite; }
		@keyframes fall-9 { 72.761% { transform: translate(53.2895vw, 72.761vh) scale(0.5579); } to { transform: translate(52.6342vw, 100vh) scale(0.5579); } }
		.snow:nth-child(10) { opacity: 0.5861; transform: translate(2.6984vw, -10px) scale(0.3202); animation: fall-10 13s -26s linear infinite; }
		@keyframes fall-10 { 44.138% { transform: translate(12.4304vw, 44.138vh) scale(0.3202); } to { transform: translate(7.5644vw, 100vh) scale(0.3202); } }
		.snow:nth-child(11) { opacity: 0.8992; transform: translate(12.2656vw, -10px) scale(0.34); animation: fall-11 24s -23s linear infinite; }
		@keyframes fall-11 { 46.879% { transform: translate(15.0919vw, 46.879vh) scale(0.34); } to { transform: translate(13.67875vw, 100vh) scale(0.34); } }
		.snow:nth-child(12) { opacity: 0.371; transform: translate(87.5662vw, -10px) scale(0.4773); animation: fall-12 20s -14s linear infinite; }
		@keyframes fall-12 { 49.568% { transform: translate(96.6518vw, 49.568vh) scale(0.4773); } to { transform: translate(92.109vw, 100vh) scale(0.4773); } }
		.snow:nth-child(13) { opacity: 0.1925; transform: translate(7.9119vw, -10px) scale(0.4301); animation: fall-13 14s -12s linear infinite; }
		@keyframes fall-13 { 54.527% { transform: translate(5.9619vw, 54.527vh) scale(0.4301); } to { transform: translate(6.9369vw, 100vh) scale(0.4301); } }
		.snow:nth-child(14) { opacity: 0.7839; transform: translate(89.8081vw, -10px) scale(0.7379); animation: fall-14 21s -6s linear infinite; }
		@keyframes fall-14 { 51.127% { transform: translate(97.8238vw, 51.127vh) scale(0.7379); } to { transform: translate(93.81595vw, 100vh) scale(0.7379); } }
		.snow:nth-child(15) { opacity: 0.6374; transform: translate(47.6919vw, -10px) scale(0.6325); animation: fall-15 11s -6s linear infinite; }
		@keyframes fall-15 { 61.42% { transform: translate(55.9528vw, 61.42vh) scale(0.6325); } to { transform: translate(51.82235vw, 100vh) scale(0.6325); } }
		.snow:nth-child(16) { opacity: 0.5453; transform: translate(34.9451vw, -10px) scale(0.1488); animation: fall-16 23s -12s linear infinite; }
		@keyframes fall-16 { 75.701% { transform: translate(30.537vw, 75.701vh) scale(0.1488); } to { transform: translate(32.74105vw, 100vh) scale(0.1488); } }
		.snow:nth-child(17) { opacity: 0.8101; transform: translate(43.95vw, -10px) scale(0.4737); animation: fall-17 18s -19s linear infinite; }
		@keyframes fall-17 { 77.978% { transform: translate(45.6778vw, 77.978vh) scale(0.4737); } to { transform: translate(44.8139vw, 100vh) scale(0.4737); } }
		.snow:nth-child(18) { opacity: 0.8822; transform: translate(39.554vw, -10px) scale(0.8218); animation: fall-18 20s -6s linear infinite; }
		@keyframes fall-18 { 32.01% { transform: translate(36.076vw, 32.01vh) scale(0.8218); } to { transform: translate(37.815vw, 100vh) scale(0.8218); } }
		.snow:nth-child(19) { opacity: 0.8503; transform: translate(51.455vw, -10px) scale(0.2025); animation: fall-19 22s -5s linear infinite; }
		@keyframes fall-19 { 47.8% { transform: translate(46.8018vw, 47.8vh) scale(0.2025); } to { transform: translate(49.1284vw, 100vh) scale(0.2025); } }
		.snow:nth-child(20) { opacity: 0.8706; transform: translate(58.338vw, -10px) scale(0.4157); animation: fall-20 16s -26s linear infinite; }
		@keyframes fall-20 { 56.617% { transform: translate(65.4788vw, 56.617vh) scale(0.4157); } to { transform: translate(61.9084vw, 100vh) scale(0.4157); } }
		.snow:nth-child(21) { opacity: 0.1188; transform: translate(52.3973vw, -10px) scale(0.86); animation: fall-21 12s -28s linear infinite; }
		@keyframes fall-21 { 77.02% { transform: translate(49.7232vw, 77.02vh) scale(0.86); } to { transform: translate(51.06025vw, 100vh) scale(0.86); } }
		.snow:nth-child(22) { opacity: 0.9697; transform: translate(8.8554vw, -10px) scale(0.1042); animation: fall-22 22s -10s linear infinite; }
		@keyframes fall-22 { 78.732% { transform: translate(13.1991vw, 78.732vh) scale(0.1042); } to { transform: translate(11.02725vw, 100vh) scale(0.1042); } }
		.snow:nth-child(23) { opacity: 0.7914; transform: translate(63.1014vw, -10px) scale(0.9927); animation: fall-23 20s -5s linear infinite; }
		@keyframes fall-23 { 43.631% { transform: translate(65.0657vw, 43.631vh) scale(0.9927); } to { transform: translate(64.08355vw, 100vh) scale(0.9927); } }
		.snow:nth-child(24) { opacity: 0.3288; transform: translate(76.9775vw, -10px) scale(0.228); animation: fall-24 18s -5s linear infinite; }
		@keyframes fall-24 { 59.206% { transform: translate(68.4658vw, 59.206vh) scale(0.228); } to { transform: translate(72.72165vw, 100vh) scale(0.228); } }
		.snow:nth-child(25) { opacity: 0.0223; transform: translate(83.2389vw, -10px) scale(0.5503); animation: fall-25 29s -19s linear infinite; }
		@keyframes fall-25 { 41.804% { transform: translate(80.1412vw, 41.804vh) scale(0.5503); } to { transform: translate(81.69005vw, 100vh) scale(0.5503); } }
		.snow:nth-child(26) { opacity: 0.6435; transform: translate(27.672vw, -10px) scale(0.6971); animation: fall-26 28s -26s linear infinite; }
		@keyframes fall-26 { 73.827% { transform: translate(24.3032vw, 73.827vh) scale(0.6971); } to { transform: translate(25.9876vw, 100vh) scale(0.6971); } }
		.snow:nth-child(27) { opacity: 0.9796; transform: translate(23.7949vw, -10px) scale(0.6831); animation: fall-27 19s -4s linear infinite; }
		@keyframes fall-27 { 63.481% { transform: translate(21.0749vw, 63.481vh) scale(0.6831); } to { transform: translate(22.4349vw, 100vh) scale(0.6831); } }
		.snow:nth-child(28) { opacity: 0.6574; transform: translate(99.3524vw, -10px) scale(0.2863); animation: fall-28 28s -13s linear infinite; }
		@keyframes fall-28 { 53.677% { transform: translate(92.4944vw, 53.677vh) scale(0.2863); } to { transform: translate(95.9234vw, 100vh) scale(0.2863); } }
		.snow:nth-child(29) { opacity: 0.6523; transform: translate(6.5348vw, -10px) scale(0.7277); animation: fall-29 11s -1s linear infinite; }
		@keyframes fall-29 { 61.583% { transform: translate(3.0282vw, 61.583vh) scale(0.7277); } to { transform: translate(4.7815vw, 100vh) scale(0.7277); } }
		.snow:nth-child(30) { opacity: 0.4992; transform: translate(37.091vw, -10px) scale(0.091); animation: fall-30 19s -22s linear infinite; }
		@keyframes fall-30 { 76.833% { transform: translate(36.3754vw, 76.833vh) scale(0.091); } to { transform: translate(36.7332vw, 100vh) scale(0.091); } }
		.snow:nth-child(31) { opacity: 0.0449; transform: translate(34.2467vw, -10px) scale(0.0058); animation: fall-31 23s -23s linear infinite; }
		@keyframes fall-31 { 38.371% { transform: translate(41.2876vw, 38.371vh) scale(0.0058); } to { transform: translate(37.76715vw, 100vh) scale(0.0058); } }
		.snow:nth-child(32) { opacity: 0.6813; transform: translate(77.7662vw, -10px) scale(0.0945); animation: fall-32 11s -15s linear infinite; }
		@keyframes fall-32 { 55.516% { transform: translate(81.9854vw, 55.516vh) scale(0.0945); } to { transform: translate(79.8758vw, 100vh) scale(0.0945); } }
		.snow:nth-child(33) { opacity: 0.7609; transform: translate(65.6931vw, -10px) scale(0.4132); animation: fall-33 18s -6s linear infinite; }
		@keyframes fall-33 { 31.046% { transform: translate(69.5185vw, 31.046vh) scale(0.4132); } to { transform: translate(67.6058vw, 100vh) scale(0.4132); } }
		.snow:nth-child(34) { opacity: 0.8503; transform: translate(97.5798vw, -10px) scale(0.8261); animation: fall-34 17s -29s linear infinite; }
		@keyframes fall-34 { 57.949% { transform: translate(103.3677vw, 57.949vh) scale(0.8261); } to { transform: translate(100.47375vw, 100vh) scale(0.8261); } }
		.snow:nth-child(35) { opacity: 0.8685; transform: translate(91.6439vw, -10px) scale(0.5171); animation: fall-35 19s -13s linear infinite; }
		@keyframes fall-35 { 68.417% { transform: translate(84.6404vw, 68.417vh) scale(0.5171); } to { transform: translate(88.14215vw, 100vh) scale(0.5171); } }
		.snow:nth-child(36) { opacity: 0.9675; transform: translate(99.6499vw, -10px) scale(0.4056); animation: fall-36 17s -26s linear infinite; }
		@keyframes fall-36 { 74.554% { transform: translate(96.4787vw, 74.554vh) scale(0.4056); } to { transform: translate(98.0643vw, 100vh) scale(0.4056); } }
		.snow:nth-child(37) { opacity: 0.9725; transform: translate(27.4073vw, -10px) scale(0.5025); animation: fall-37 26s -25s linear infinite; }
		@keyframes fall-37 { 37.803% { transform: translate(21.9948vw, 37.803vh) scale(0.5025); } to { transform: translate(24.70105vw, 100vh) scale(0.5025); } }
		.snow:nth-child(38) { opacity: 0.0395; transform: translate(92.211vw, -10px) scale(0.4636); animation: fall-38 25s -3s linear infinite; }
		@keyframes fall-38 { 54.776% { transform: translate(82.5025vw, 54.776vh) scale(0.4636); } to { transform: translate(87.35675vw, 100vh) scale(0.4636); } }
		.snow:nth-child(39) { opacity: 0.5049; transform: translate(10.8604vw, -10px) scale(0.2885); animation: fall-39 17s -14s linear infinite; }
		@keyframes fall-39 { 43.073% { transform: translate(8.2873vw, 43.073vh) scale(0.2885); } to { transform: translate(9.57385vw, 100vh) scale(0.2885); } }
		.snow:nth-child(40) { opacity: 0.2462; transform: translate(90.4412vw, -10px) scale(0.887); animation: fall-40 14s -21s linear infinite; }
		@keyframes fall-40 { 54.999% { transform: translate(93.4805vw, 54.999vh) scale(0.887); } to { transform: translate(91.96085vw, 100vh) scale(0.887); } }
		.snow:nth-child(41) { opacity: 0.4487; transform: translate(58.1844vw, -10px) scale(0.905); animation: fall-41 10s -28s linear infinite; }
		@keyframes fall-41 { 73.716% { transform: translate(62.9043vw, 73.716vh) scale(0.905); } to { transform: translate(60.54435vw, 100vh) scale(0.905); } }
		.snow:nth-child(42) { opacity: 0.4639; transform: translate(54.3241vw, -10px) scale(0.5163); animation: fall-42 30s -1s linear infinite; }
		@keyframes fall-42 { 62.045% { transform: translate(50.5815vw, 62.045vh) scale(0.5163); } to { transform: translate(52.4528vw, 100vh) scale(0.5163); } }
		.snow:nth-child(43) { opacity: 0.3527; transform: translate(67.0898vw, -10px) scale(0.7653); animation: fall-43 30s -18s linear infinite; }
		@keyframes fall-43 { 69.906% { transform: translate(57.7421vw, 69.906vh) scale(0.7653); } to { transform: translate(62.41595vw, 100vh) scale(0.7653); } }
		.snow:nth-child(44) { opacity: 0.3412; transform: translate(88.7345vw, -10px) scale(0.6706); animation: fall-44 19s -7s linear infinite; }
		@keyframes fall-44 { 69.192% { transform: translate(82.1852vw, 69.192vh) scale(0.6706); } to { transform: translate(85.45985vw, 100vh) scale(0.6706); } }
		.snow:nth-child(45) { opacity: 0.9856; transform: translate(69.1597vw, -10px) scale(0.2398); animation: fall-45 16s -20s linear infinite; }
		@keyframes fall-45 { 69.19% { transform: translate(74.1987vw, 69.19vh) scale(0.2398); } to { transform: translate(71.6792vw, 100vh) scale(0.2398); } }
		.snow:nth-child(46) { opacity: 0.7795; transform: translate(88.6741vw, -10px) scale(0.556); animation: fall-46 11s -20s linear infinite; }
		@keyframes fall-46 { 73.171% { transform: translate(83.0667vw, 73.171vh) scale(0.556); } to { transform: translate(85.8704vw, 100vh) scale(0.556); } }
		.snow:nth-child(47) { opacity: 0.9124; transform: translate(48.3531vw, -10px) scale(0.7337); animation: fall-47 24s -30s linear infinite; }
		@keyframes fall-47 { 65.851% { transform: translate(53.6958vw, 65.851vh) scale(0.7337); } to { transform: translate(51.02445vw, 100vh) scale(0.7337); } }
		.snow:nth-child(48) { opacity: 0.0335; transform: translate(3.4931vw, -10px) scale(0.962); animation: fall-48 19s -26s linear infinite; }
		@keyframes fall-48 { 57.8% { transform: translate(-5.9627vw, 57.8vh) scale(0.962); } to { transform: translate(-1.2348vw, 100vh) scale(0.962); } }
		.snow:nth-child(49) { opacity: 0.4328; transform: translate(94.0055vw, -10px) scale(0.1461); animation: fall-49 28s -5s linear infinite; }
		@keyframes fall-49 { 57.015% { transform: translate(84.445vw, 57.015vh) scale(0.1461); } to { transform: translate(89.22525vw, 100vh) scale(0.1461); } }
		.snow:nth-child(50) { opacity: 0.4886; transform: translate(79.2492vw, -10px) scale(0.0692); animation: fall-50 12s -6s linear infinite; }
		@keyframes fall-50 { 46.447% { transform: translate(75.7387vw, 46.447vh) scale(0.0692); } to { transform: translate(77.49395vw, 100vh) scale(0.0692); } }
		.snow:nth-child(51) { opacity: 0.5571; transform: translate(68.5416vw, -10px) scale(0.9624); animation: fall-51 12s -21s linear infinite; }
		@keyframes fall-51 { 78.535% { transform: translate(70.5239vw, 78.535vh) scale(0.9624); } to { transform: translate(69.53275vw, 100vh) scale(0.9624); } }
		.snow:nth-child(52) { opacity: 0.1512; transform: translate(94.3998vw, -10px) scale(0.6747); animation: fall-52 13s -29s linear infinite; }
		@keyframes fall-52 { 46.811% { transform: translate(101.493vw, 46.811vh) scale(0.6747); } to { transform: translate(97.9464vw, 100vh) scale(0.6747); } }
		.snow:nth-child(53) { opacity: 0.4197; transform: translate(66.3614vw, -10px) scale(0.8206); animation: fall-53 15s -13s linear infinite; }
		@keyframes fall-53 { 67.062% { transform: translate(60.6654vw, 67.062vh) scale(0.8206); } to { transform: translate(63.5134vw, 100vh) scale(0.8206); } }
		.snow:nth-child(54) { opacity: 0.8419; transform: translate(6.9093vw, -10px) scale(0.3702); animation: fall-54 25s -24s linear infinite; }
		@keyframes fall-54 { 44.752% { transform: translate(-0.0611vw, 44.752vh) scale(0.3702); } to { transform: translate(3.4241vw, 100vh) scale(0.3702); } }
		.snow:nth-child(55) { opacity: 0.6996; transform: translate(86.8805vw, -10px) scale(0.9671); animation: fall-55 19s -4s linear infinite; }
		@keyframes fall-55 { 62.859% { transform: translate(79.1067vw, 62.859vh) scale(0.9671); } to { transform: translate(82.9936vw, 100vh) scale(0.9671); } }
		.snow:nth-child(56) { opacity: 0.3249; transform: translate(95.7869vw, -10px) scale(0.9472); animation: fall-56 28s -3s linear infinite; }
		@keyframes fall-56 { 66.803% { transform: translate(100.6087vw, 66.803vh) scale(0.9472); } to { transform: translate(98.1978vw, 100vh) scale(0.9472); } }
		.snow:nth-child(57) { opacity: 0.1114; transform: translate(92.2957vw, -10px) scale(0.3536); animation: fall-57 28s -3s linear infinite; }
		@keyframes fall-57 { 47.897% { transform: translate(101.8233vw, 47.897vh) scale(0.3536); } to { transform: translate(97.0595vw, 100vh) scale(0.3536); } }
		.snow:nth-child(58) { opacity: 0.0546; transform: translate(69.8625vw, -10px) scale(0.3064); animation: fall-58 16s -28s linear infinite; }
		@keyframes fall-58 { 33.339% { transform: translate(74.0282vw, 33.339vh) scale(0.3064); } to { transform: translate(71.94535vw, 100vh) scale(0.3064); } }
		.snow:nth-child(59) { opacity: 0.552; transform: translate(68.0237vw, -10px) scale(0.6224); animation: fall-59 11s -19s linear infinite; }
		@keyframes fall-59 { 41.075% { transform: translate(62.1579vw, 41.075vh) scale(0.6224); } to { transform: translate(65.0908vw, 100vh) scale(0.6224); } }
		.snow:nth-child(60) { opacity: 0.8679; transform: translate(56.6539vw, -10px) scale(0.8583); animation: fall-60 27s -1s linear infinite; }
		@keyframes fall-60 { 67.312% { transform: translate(59.9062vw, 67.312vh) scale(0.8583); } to { transform: translate(58.28005vw, 100vh) scale(0.8583); } }
		.snow:nth-child(61) { opacity: 0.5875; transform: translate(9.8897vw, -10px) scale(0.7246); animation: fall-61 20s -26s linear infinite; }
		@keyframes fall-61 { 69.555% { transform: translate(9.5144vw, 69.555vh) scale(0.7246); } to { transform: translate(9.70205vw, 100vh) scale(0.7246); } }
		.snow:nth-child(62) { opacity: 0.5696; transform: translate(7.126vw, -10px) scale(0.5718); animation: fall-62 22s -1s linear infinite; }
		@keyframes fall-62 { 64.899% { transform: translate(15.3574vw, 64.899vh) scale(0.5718); } to { transform: translate(11.2417vw, 100vh) scale(0.5718); } }
		.snow:nth-child(63) { opacity: 0.435; transform: translate(98.0816vw, -10px) scale(0.8682); animation: fall-63 26s -1s linear infinite; }
		@keyframes fall-63 { 65.2% { transform: translate(88.2032vw, 65.2vh) scale(0.8682); } to { transform: translate(93.1424vw, 100vh) scale(0.8682); } }
		.snow:nth-child(64) { opacity: 0.3166; transform: translate(92.7457vw, -10px) scale(0.2915); animation: fall-64 15s -28s linear infinite; }
		@keyframes fall-64 { 78.731% { transform: translate(92.0076vw, 78.731vh) scale(0.2915); } to { transform: translate(92.37665vw, 100vh) scale(0.2915); } }
		.snow:nth-child(65) { opacity: 0.8014; transform: translate(96.9061vw, -10px) scale(0.0392); animation: fall-65 22s -7s linear infinite; }
		@keyframes fall-65 { 34.526% { transform: translate(100.0149vw, 34.526vh) scale(0.0392); } to { transform: translate(98.4605vw, 100vh) scale(0.0392); } }
		.snow:nth-child(66) { opacity: 0.6209; transform: translate(21.7451vw, -10px) scale(0.2948); animation: fall-66 28s -7s linear infinite; }
		@keyframes fall-66 { 71.274% { transform: translate(15.4087vw, 71.274vh) scale(0.2948); } to { transform: translate(18.5769vw, 100vh) scale(0.2948); } }
		.snow:nth-child(67) { opacity: 0.2437; transform: translate(9.9495vw, -10px) scale(0.6158); animation: fall-67 25s -8s linear infinite; }
		@keyframes fall-67 { 49.737% { transform: translate(19.1441vw, 49.737vh) scale(0.6158); } to { transform: translate(14.5468vw, 100vh) scale(0.6158); } }
		.snow:nth-child(68) { opacity: 0.8846; transform: translate(27.4104vw, -10px) scale(0.1332); animation: fall-68 12s -27s linear infinite; }
		@keyframes fall-68 { 79.247% { transform: translate(36.6133vw, 79.247vh) scale(0.1332); } to { transform: translate(32.01185vw, 100vh) scale(0.1332); } }
		.snow:nth-child(69) { opacity: 0.924; transform: translate(97.6153vw, -10px) scale(0.7978); animation: fall-69 21s -29s linear infinite; }
		@keyframes fall-69 { 70.961% { transform: translate(98.2854vw, 70.961vh) scale(0.7978); } to { transform: translate(97.95035vw, 100vh) scale(0.7978); } }
		.snow:nth-child(70) { opacity: 0.0731; transform: translate(23.2823vw, -10px) scale(0.5295); animation: fall-70 15s -28s linear infinite; }
		@keyframes fall-70 { 67.196% { transform: translate(32.0362vw, 67.196vh) scale(0.5295); } to { transform: translate(27.65925vw, 100vh) scale(0.5295); } }
		.snow:nth-child(71) { opacity: 0.0684; transform: translate(34.5186vw, -10px) scale(0.1996); animation: fall-71 25s -11s linear infinite; }
		@keyframes fall-71 { 71.672% { transform: translate(41.367vw, 71.672vh) scale(0.1996); } to { transform: translate(37.9428vw, 100vh) scale(0.1996); } }
		.snow:nth-child(72) { opacity: 0.5856; transform: translate(0.8589vw, -10px) scale(0.6019); animation: fall-72 25s -20s linear infinite; }
		@keyframes fall-72 { 74.213% { transform: translate(4.0186vw, 74.213vh) scale(0.6019); } to { transform: translate(2.43875vw, 100vh) scale(0.6019); } }
		.snow:nth-child(73) { opacity: 0.2699; transform: translate(65.1736vw, -10px) scale(0.6826); animation: fall-73 15s -3s linear infinite; }
		@keyframes fall-73 { 47.389% { transform: translate(69.2734vw, 47.389vh) scale(0.6826); } to { transform: translate(67.2235vw, 100vh) scale(0.6826); } }
		.snow:nth-child(74) { opacity: 0.6485; transform: translate(20.6833vw, -10px) scale(0.702); animation: fall-74 17s -20s linear infinite; }
		@keyframes fall-74 { 52.299% { transform: translate(24.6433vw, 52.299vh) scale(0.702); } to { transform: translate(22.6633vw, 100vh) scale(0.702); } }
		.snow:nth-child(75) { opacity: 0.2201; transform: translate(26.5602vw, -10px) scale(0.9865); animation: fall-75 16s -30s linear infinite; }
		@keyframes fall-75 { 43.797% { transform: translate(32.7665vw, 43.797vh) scale(0.9865); } to { transform: translate(29.66335vw, 100vh) scale(0.9865); } }
		.snow:nth-child(76) { opacity: 0.6728; transform: translate(17.66vw, -10px) scale(0.1504); animation: fall-76 17s -23s linear infinite; }
		@keyframes fall-76 { 54.653% { transform: translate(17.341vw, 54.653vh) scale(0.1504); } to { transform: translate(17.5005vw, 100vh) scale(0.1504); } }
		.snow:nth-child(77) { opacity: 0.1741; transform: translate(72.7379vw, -10px) scale(0.2594); animation: fall-77 12s -13s linear infinite; }
		@keyframes fall-77 { 68.022% { transform: translate(63.0209vw, 68.022vh) scale(0.2594); } to { transform: translate(67.8794vw, 100vh) scale(0.2594); } }
		.snow:nth-child(78) { opacity: 0.779; transform: translate(99.0246vw, -10px) scale(0.224); animation: fall-78 27s -4s linear infinite; }
		@keyframes fall-78 { 35.035% { transform: translate(104.6579vw, 35.035vh) scale(0.224); } to { transform: translate(101.84125vw, 100vh) scale(0.224); } }
		.snow:nth-child(79) { opacity: 0.0337; transform: translate(84.2568vw, -10px) scale(0.2837); animation: fall-79 10s -11s linear infinite; }
		@keyframes fall-79 { 46.857% { transform: translate(79.0125vw, 46.857vh) scale(0.2837); } to { transform: translate(81.63465vw, 100vh) scale(0.2837); } }
		.snow:nth-child(80) { opacity: 0.8201; transform: translate(86.6832vw, -10px) scale(0.1727); animation: fall-80 29s -17s linear infinite; }
		@keyframes fall-80 { 51.788% { transform: translate(89.8747vw, 51.788vh) scale(0.1727); } to { transform: translate(88.27895vw, 100vh) scale(0.1727); } }
		.snow:nth-child(81) { opacity: 0.2876; transform: translate(12.3126vw, -10px) scale(0.016); animation: fall-81 24s -1s linear infinite; }
		@keyframes fall-81 { 30.416% { transform: translate(19.6026vw, 30.416vh) scale(0.016); } to { transform: translate(15.9576vw, 100vh) scale(0.016); } }
		.snow:nth-child(82) { opacity: 0.0998; transform: translate(7.7679vw, -10px) scale(0.2037); animation: fall-82 20s -30s linear infinite; }
		@keyframes fall-82 { 71.204% { transform: translate(8.764vw, 71.204vh) scale(0.2037); } to { transform: translate(8.26595vw, 100vh) scale(0.2037); } }
		.snow:nth-child(83) { opacity: 0.1893; transform: translate(40.003vw, -10px) scale(0.5133); animation: fall-83 22s -24s linear infinite; }
		@keyframes fall-83 { 50.462% { transform: translate(35.4338vw, 50.462vh) scale(0.5133); } to { transform: translate(37.7184vw, 100vh) scale(0.5133); } }
		.snow:nth-child(84) { opacity: 0.1064; transform: translate(45.8338vw, -10px) scale(0.5622); animation: fall-84 29s -6s linear infinite; }
		@keyframes fall-84 { 49.99% { transform: translate(52.2235vw, 49.99vh) scale(0.5622); } to { transform: translate(49.02865vw, 100vh) scale(0.5622); } }
		.snow:nth-child(85) { opacity: 0.3294; transform: translate(1.522vw, -10px) scale(0.872); animation: fall-85 21s -18s linear infinite; }
		@keyframes fall-85 { 60.932% { transform: translate(10.583vw, 60.932vh) scale(0.872); } to { transform: translate(6.0525vw, 100vh) scale(0.872); } }
		.snow:nth-child(86) { opacity: 0.6982; transform: translate(42.0277vw, -10px) scale(0.1228); animation: fall-86 14s -27s linear infinite; }
		@keyframes fall-86 { 54.441% { transform: translate(41.9119vw, 54.441vh) scale(0.1228); } to { transform: translate(41.9698vw, 100vh) scale(0.1228); } }
		.snow:nth-child(87) { opacity: 0.4797; transform: translate(78.3547vw, -10px) scale(0.1058); animation: fall-87 12s -12s linear infinite; }
		@keyframes fall-87 { 56.565% { transform: translate(73.899vw, 56.565vh) scale(0.1058); } to { transform: translate(76.12685vw, 100vh) scale(0.1058); } }
		.snow:nth-child(88) { opacity: 0.3726; transform: translate(5.1454vw, -10px) scale(0.1527); animation: fall-88 21s -24s linear infinite; }
		@keyframes fall-88 { 31.758% { transform: translate(11.2388vw, 31.758vh) scale(0.1527); } to { transform: translate(8.1921vw, 100vh) scale(0.1527); } }
		.snow:nth-child(89) { opacity: 0.364; transform: translate(8.9876vw, -10px) scale(0.0214); animation: fall-89 10s -10s linear infinite; }
		@keyframes fall-89 { 33.443% { transform: translate(11.2543vw, 33.443vh) scale(0.0214); } to { transform: translate(10.12095vw, 100vh) scale(0.0214); } }
		.snow:nth-child(90) { opacity: 0.298; transform: translate(45.4984vw, -10px) scale(0.5705); animation: fall-90 12s -19s linear infinite; }
		@keyframes fall-90 { 78.879% { transform: translate(38.6108vw, 78.879vh) scale(0.5705); } to { transform: translate(42.0546vw, 100vh) scale(0.5705); } }
		.snow:nth-child(91) { opacity: 0.2584; transform: translate(83.9542vw, -10px) scale(0.3974); animation: fall-91 13s -29s linear infinite; }
		@keyframes fall-91 { 40.686% { transform: translate(85.5081vw, 40.686vh) scale(0.3974); } to { transform: translate(84.73115vw, 100vh) scale(0.3974); } }
		.snow:nth-child(92) { opacity: 0.782; transform: translate(26.4162vw, -10px) scale(0.8793); animation: fall-92 22s -26s linear infinite; }
		@keyframes fall-92 { 57.374% { transform: translate(24.4782vw, 57.374vh) scale(0.8793); } to { transform: translate(25.4472vw, 100vh) scale(0.8793); } }
		.snow:nth-child(93) { opacity: 0.0742; transform: translate(8.3343vw, -10px) scale(0.0573); animation: fall-93 14s -3s linear infinite; }
		@keyframes fall-93 { 77.278% { transform: translate(5.9529vw, 77.278vh) scale(0.0573); } to { transform: translate(7.1436vw, 100vh) scale(0.0573); } }
		.snow:nth-child(94) { opacity: 0.419; transform: translate(83.9678vw, -10px) scale(0.4744); animation: fall-94 21s -9s linear infinite; }
		@keyframes fall-94 { 37.855% { transform: translate(93.8561vw, 37.855vh) scale(0.4744); } to { transform: translate(88.91195vw, 100vh) scale(0.4744); } }
		.snow:nth-child(95) { opacity: 0.915; transform: translate(27.561vw, -10px) scale(0.1302); animation: fall-95 12s -16s linear infinite; }
		@keyframes fall-95 { 71.219% { transform: translate(32.1871vw, 71.219vh) scale(0.1302); } to { transform: translate(29.87405vw, 100vh) scale(0.1302); } }
		.snow:nth-child(96) { opacity: 0.5884; transform: translate(61.5663vw, -10px) scale(0.7743); animation: fall-96 20s -1s linear infinite; }
		@keyframes fall-96 { 67.211% { transform: translate(52.9403vw, 67.211vh) scale(0.7743); } to { transform: translate(57.2533vw, 100vh) scale(0.7743); } }
		.snow:nth-child(97) { opacity: 0.5653; transform: translate(45.0704vw, -10px) scale(0.8168); animation: fall-97 22s -14s linear infinite; }
		@keyframes fall-97 { 52.472% { transform: translate(50.3723vw, 52.472vh) scale(0.8168); } to { transform: translate(47.72135vw, 100vh) scale(0.8168); } }
		.snow:nth-child(98) { opacity: 0.1885; transform: translate(3.3492vw, -10px) scale(0.0078); animation: fall-98 28s -9s linear infinite; }
		@keyframes fall-98 { 73.06% { transform: translate(7.5439vw, 73.06vh) scale(0.0078); } to { transform: translate(5.44655vw, 100vh) scale(0.0078); } }
		.snow:nth-child(99) { opacity: 0.1926; transform: translate(28.7685vw, -10px) scale(0.6916); animation: fall-99 17s -18s linear infinite; }
		@keyframes fall-99 { 57.533% { transform: translate(26.2276vw, 57.533vh) scale(0.6916); } to { transform: translate(27.49805vw, 100vh) scale(0.6916); } }
		.snow:nth-child(100) { opacity: 0.26; transform: translate(34.5311vw, -10px) scale(0.4906); animation: fall-100 11s -16s linear infinite; }
		@keyframes fall-100 { 64.142% { transform: translate(26.9157vw, 64.142vh) scale(0.4906); } to { transform: translate(30.7234vw, 100vh) scale(0.4906); } }
		.snow:nth-child(101) { opacity: 0.0919; transform: translate(47.0484vw, -10px) scale(0.4129); animation: fall-101 20s -21s linear infinite; }
		@keyframes fall-101 { 50.896% { transform: translate(46.8267vw, 50.896vh) scale(0.4129); } to { transform: translate(46.93755vw, 100vh) scale(0.4129); } }
		.snow:nth-child(102) { opacity: 0.8244; transform: translate(43.0972vw, -10px) scale(0.9727); animation: fall-102 23s -24s linear infinite; }
		@keyframes fall-102 { 60.551% { transform: translate(44.1431vw, 60.551vh) scale(0.9727); } to { transform: translate(43.62015vw, 100vh) scale(0.9727); } }
		.snow:nth-child(103) { opacity: 0.6495; transform: translate(45.8358vw, -10px) scale(0.7367); animation: fall-103 11s -19s linear infinite; }
		@keyframes fall-103 { 42.453% { transform: translate(36.5827vw, 42.453vh) scale(0.7367); } to { transform: translate(41.20925vw, 100vh) scale(0.7367); } }
		.snow:nth-child(104) { opacity: 0.2049; transform: translate(39.1634vw, -10px) scale(0.6932); animation: fall-104 24s -20s linear infinite; }
		@keyframes fall-104 { 31.485% { transform: translate(42.3458vw, 31.485vh) scale(0.6932); } to { transform: translate(40.7546vw, 100vh) scale(0.6932); } }
		.snow:nth-child(105) { opacity: 0.1122; transform: translate(15.8963vw, -10px) scale(0.6492); animation: fall-105 11s -18s linear infinite; }
		@keyframes fall-105 { 44.043% { transform: translate(7.475vw, 44.043vh) scale(0.6492); } to { transform: translate(11.68565vw, 100vh) scale(0.6492); } }
		.snow:nth-child(106) { opacity: 0.5732; transform: translate(56.8274vw, -10px) scale(0.04); animation: fall-106 16s -27s linear infinite; }
		@keyframes fall-106 { 34.243% { transform: translate(56.0357vw, 34.243vh) scale(0.04); } to { transform: translate(56.43155vw, 100vh) scale(0.04); } }
		.snow:nth-child(107) { opacity: 0.0349; transform: translate(69.2861vw, -10px) scale(0.2633); animation: fall-107 27s -23s linear infinite; }
		@keyframes fall-107 { 69.506% { transform: translate(67.9692vw, 69.506vh) scale(0.2633); } to { transform: translate(68.62765vw, 100vh) scale(0.2633); } }
		.snow:nth-child(108) { opacity: 0.6591; transform: translate(79.8462vw, -10px) scale(0.2784); animation: fall-108 20s -17s linear infinite; }
		@keyframes fall-108 { 40.449% { transform: translate(73.2244vw, 40.449vh) scale(0.2784); } to { transform: translate(76.5353vw, 100vh) scale(0.2784); } }
		.snow:nth-child(109) { opacity: 0.0256; transform: translate(34.1347vw, -10px) scale(0.2551); animation: fall-109 28s -27s linear infinite; }
		@keyframes fall-109 { 62.213% { transform: translate(37.884vw, 62.213vh) scale(0.2551); } to { transform: translate(36.00935vw, 100vh) scale(0.2551); } }
		.snow:nth-child(110) { opacity: 0.6359; transform: translate(27.5514vw, -10px) scale(0.5217); animation: fall-110 20s -1s linear infinite; }
		@keyframes fall-110 { 65.373% { transform: translate(33.1357vw, 65.373vh) scale(0.5217); } to { transform: translate(30.34355vw, 100vh) scale(0.5217); } }
		.snow:nth-child(111) { opacity: 0.5767; transform: translate(26.7987vw, -10px) scale(0.3213); animation: fall-111 23s -20s linear infinite; }
		@keyframes fall-111 { 58.837% { transform: translate(33.2398vw, 58.837vh) scale(0.3213); } to { transform: translate(30.01925vw, 100vh) scale(0.3213); } }
		.snow:nth-child(112) { opacity: 0.8822; transform: translate(23.6927vw, -10px) scale(0.7821); animation: fall-112 10s -6s linear infinite; }
		@keyframes fall-112 { 65.032% { transform: translate(24.3275vw, 65.032vh) scale(0.7821); } to { transform: translate(24.0101vw, 100vh) scale(0.7821); } }
		.snow:nth-child(113) { opacity: 0.4717; transform: translate(88.904vw, -10px) scale(0.5548); animation: fall-113 29s -19s linear infinite; }
		@keyframes fall-113 { 57.947% { transform: translate(92.8906vw, 57.947vh) scale(0.5548); } to { transform: translate(90.8973vw, 100vh) scale(0.5548); } }
		.snow:nth-child(114) { opacity: 0.8565; transform: translate(30.3704vw, -10px) scale(0.9343); animation: fall-114 24s -17s linear infinite; }
		@keyframes fall-114 { 55.697% { transform: translate(38.4142vw, 55.697vh) scale(0.9343); } to { transform: translate(34.3923vw, 100vh) scale(0.9343); } }
		.snow:nth-child(115) { opacity: 0.5657; transform: translate(15.9763vw, -10px) scale(0.9377); animation: fall-115 24s -26s linear infinite; }
		@keyframes fall-115 { 58.92% { transform: translate(20.5306vw, 58.92vh) scale(0.9377); } to { transform: translate(18.25345vw, 100vh) scale(0.9377); } }
		.snow:nth-child(116) { opacity: 0.9962; transform: translate(25.7795vw, -10px) scale(0.627); animation: fall-116 11s -16s linear infinite; }
		@keyframes fall-116 { 32.121% { transform: translate(31.4894vw, 32.121vh) scale(0.627); } to { transform: translate(28.63445vw, 100vh) scale(0.627); } }
		.snow:nth-child(117) { opacity: 0.7388; transform: translate(29.4177vw, -10px) scale(0.2293); animation: fall-117 16s -22s linear infinite; }
		@keyframes fall-117 { 51.622% { transform: translate(37.4148vw, 51.622vh) scale(0.2293); } to { transform: translate(33.41625vw, 100vh) scale(0.2293); } }
		.snow:nth-child(118) { opacity: 0.2737; transform: translate(81.6516vw, -10px) scale(0.623); animation: fall-118 16s -12s linear infinite; }
		@keyframes fall-118 { 67.618% { transform: translate(73.8003vw, 67.618vh) scale(0.623); } to { transform: translate(77.72595vw, 100vh) scale(0.623); } }
		.snow:nth-child(119) { opacity: 0.8093; transform: translate(21.2185vw, -10px) scale(0.2385); animation: fall-119 24s -27s linear infinite; }
		@keyframes fall-119 { 62.462% { transform: translate(22.8927vw, 62.462vh) scale(0.2385); } to { transform: translate(22.0556vw, 100vh) scale(0.2385); } }
		.snow:nth-child(120) { opacity: 0.454; transform: translate(9.6876vw, -10px) scale(0.6918); animation: fall-120 21s -2s linear infinite; }
		@keyframes fall-120 { 66.511% { transform: translate(11.598vw, 66.511vh) scale(0.6918); } to { transform: translate(10.6428vw, 100vh) scale(0.6918); } }
		.snow:nth-child(121) { opacity: 0.8984; transform: translate(89.191vw, -10px) scale(0.4024); animation: fall-121 20s -16s linear infinite; }
		@keyframes fall-121 { 53.422% { transform: translate(98.6217vw, 53.422vh) scale(0.4024); } to { transform: translate(93.90635vw, 100vh) scale(0.4024); } }
		.snow:nth-child(122) { opacity: 0.9502; transform: translate(67.2596vw, -10px) scale(0.8136); animation: fall-122 14s -5s linear infinite; }
		@keyframes fall-122 { 53.827% { transform: translate(67.5459vw, 53.827vh) scale(0.8136); } to { transform: translate(67.40275vw, 100vh) scale(0.8136); } }
		.snow:nth-child(123) { opacity: 0.0104; transform: translate(25.4059vw, -10px) scale(0.71); animation: fall-123 15s -29s linear infinite; }
		@keyframes fall-123 { 54.397% { transform: translate(33.9611vw, 54.397vh) scale(0.71); } to { transform: translate(29.6835vw, 100vh) scale(0.71); } }
		.snow:nth-child(124) { opacity: 0.7964; transform: translate(52.5028vw, -10px) scale(0.4148); animation: fall-124 11s -10s linear infinite; }
		@keyframes fall-124 { 38.848% { transform: translate(51.3811vw, 38.848vh) scale(0.4148); } to { transform: translate(51.94195vw, 100vh) scale(0.4148); } }
		.snow:nth-child(125) { opacity: 0.0325; transform: translate(18.6285vw, -10px) scale(0.8739); animation: fall-125 24s -12s linear infinite; }
		@keyframes fall-125 { 59.387% { transform: translate(18.346vw, 59.387vh) scale(0.8739); } to { transform: translate(18.48725vw, 100vh) scale(0.8739); } }
		.snow:nth-child(126) { opacity: 0.5021; transform: translate(23.6306vw, -10px) scale(0.7372); animation: fall-126 15s -20s linear infinite; }
		@keyframes fall-126 { 43.207% { transform: translate(24.3563vw, 43.207vh) scale(0.7372); } to { transform: translate(23.99345vw, 100vh) scale(0.7372); } }
		.snow:nth-child(127) { opacity: 0.31; transform: translate(97.5779vw, -10px) scale(0.7725); animation: fall-127 13s -5s linear infinite; }
		@keyframes fall-127 { 68.622% { transform: translate(89.9901vw, 68.622vh) scale(0.7725); } to { transform: translate(93.784vw, 100vh) scale(0.7725); } }
		.snow:nth-child(128) { opacity: 0.7854; transform: translate(75.4985vw, -10px) scale(0.7456); animation: fall-128 16s -24s linear infinite; }
		@keyframes fall-128 { 35.195% { transform: translate(80.9509vw, 35.195vh) scale(0.7456); } to { transform: translate(78.2247vw, 100vh) scale(0.7456); } }
		.snow:nth-child(129) { opacity: 0.8768; transform: translate(91.4801vw, -10px) scale(0.6958); animation: fall-129 18s -22s linear infinite; }
		@keyframes fall-129 { 41.175% { transform: translate(93.1699vw, 41.175vh) scale(0.6958); } to { transform: translate(92.325vw, 100vh) scale(0.6958); } }
		.snow:nth-child(130) { opacity: 0.3268; transform: translate(97.5691vw, -10px) scale(0.7711); animation: fall-130 11s -10s linear infinite; }
		@keyframes fall-130 { 50.91% { transform: translate(95.0295vw, 50.91vh) scale(0.7711); } to { transform: translate(96.2993vw, 100vh) scale(0.7711); } }
		.snow:nth-child(131) { opacity: 0.7266; transform: translate(74.4299vw, -10px) scale(0.784); animation: fall-131 20s -9s linear infinite; }
		@keyframes fall-131 { 67.539% { transform: translate(82.5233vw, 67.539vh) scale(0.784); } to { transform: translate(78.4766vw, 100vh) scale(0.784); } }
		.snow:nth-child(132) { opacity: 0.8857; transform: translate(96.6947vw, -10px) scale(0.7674); animation: fall-132 30s -10s linear infinite; }
		@keyframes fall-132 { 75.484% { transform: translate(92.1076vw, 75.484vh) scale(0.7674); } to { transform: translate(94.40115vw, 100vh) scale(0.7674); } }
		.snow:nth-child(133) { opacity: 0.3973; transform: translate(24.0027vw, -10px) scale(0.5896); animation: fall-133 12s -13s linear infinite; }
		@keyframes fall-133 { 76.764% { transform: translate(19.641vw, 76.764vh) scale(0.5896); } to { transform: translate(21.82185vw, 100vh) scale(0.5896); } }
		.snow:nth-child(134) { opacity: 0.253; transform: translate(73.7629vw, -10px) scale(0.9075); animation: fall-134 16s -17s linear infinite; }
		@keyframes fall-134 { 43.06% { transform: translate(75.0643vw, 43.06vh) scale(0.9075); } to { transform: translate(74.4136vw, 100vh) scale(0.9075); } }
		.snow:nth-child(135) { opacity: 0.5121; transform: translate(83.5906vw, -10px) scale(0.5162); animation: fall-135 11s -25s linear infinite; }
		@keyframes fall-135 { 45.299% { transform: translate(74.2163vw, 45.299vh) scale(0.5162); } to { transform: translate(78.90345vw, 100vh) scale(0.5162); } }
		.snow:nth-child(136) { opacity: 0.823; transform: translate(7.8936vw, -10px) scale(0.4241); animation: fall-136 23s -21s linear infinite; }
		@keyframes fall-136 { 32.51% { transform: translate(15.1162vw, 32.51vh) scale(0.4241); } to { transform: translate(11.5049vw, 100vh) scale(0.4241); } }
		.snow:nth-child(137) { opacity: 0.0787; transform: translate(40.4086vw, -10px) scale(0.9831); animation: fall-137 20s -10s linear infinite; }
		@keyframes fall-137 { 78.042% { transform: translate(37.7603vw, 78.042vh) scale(0.9831); } to { transform: translate(39.08445vw, 100vh) scale(0.9831); } }
		.snow:nth-child(138) { opacity: 0.0161; transform: translate(97.3001vw, -10px) scale(0.0252); animation: fall-138 29s -12s linear infinite; }
		@keyframes fall-138 { 45.035% { transform: translate(91.7406vw, 45.035vh) scale(0.0252); } to { transform: translate(94.52035vw, 100vh) scale(0.0252); } }
		.snow:nth-child(139) { opacity: 0.0231; transform: translate(6.1064vw, -10px) scale(0.105); animation: fall-139 19s -10s linear infinite; }
		@keyframes fall-139 { 50.735% { transform: translate(-1.6296vw, 50.735vh) scale(0.105); } to { transform: translate(2.2384vw, 100vh) scale(0.105); } }
		.snow:nth-child(140) { opacity: 0.302; transform: translate(1.2552vw, -10px) scale(0.669); animation: fall-140 13s -14s linear infinite; }
		@keyframes fall-140 { 36.078% { transform: translate(-2.2182vw, 36.078vh) scale(0.669); } to { transform: translate(-0.4815vw, 100vh) scale(0.669); } }
		.snow:nth-child(141) { opacity: 0.7712; transform: translate(6.9894vw, -10px) scale(0.9483); animation: fall-141 18s -18s linear infinite; }
		@keyframes fall-141 { 38.647% { transform: translate(11.0418vw, 38.647vh) scale(0.9483); } to { transform: translate(9.0156vw, 100vh) scale(0.9483); } }
		.snow:nth-child(142) { opacity: 0.9918; transform: translate(62.6869vw, -10px) scale(0.7316); animation: fall-142 28s -14s linear infinite; }
		@keyframes fall-142 { 51.266% { transform: translate(65.4493vw, 51.266vh) scale(0.7316); } to { transform: translate(64.0681vw, 100vh) scale(0.7316); } }
		.snow:nth-child(143) { opacity: 0.1989; transform: translate(60.011vw, -10px) scale(0.0012); animation: fall-143 15s -10s linear infinite; }
		@keyframes fall-143 { 71.287% { transform: translate(56.3388vw, 71.287vh) scale(0.0012); } to { transform: translate(58.1749vw, 100vh) scale(0.0012); } }
		.snow:nth-child(144) { opacity: 0.9754; transform: translate(97.4586vw, -10px) scale(0.5482); animation: fall-144 15s -30s linear infinite; }
		@keyframes fall-144 { 54.476% { transform: translate(96.4049vw, 54.476vh) scale(0.5482); } to { transform: translate(96.93175vw, 100vh) scale(0.5482); } }
		.snow:nth-child(145) { opacity: 0.713; transform: translate(9.7041vw, -10px) scale(0.8829); animation: fall-145 13s -26s linear infinite; }
		@keyframes fall-145 { 60.609% { transform: translate(7.9786vw, 60.609vh) scale(0.8829); } to { transform: translate(8.84135vw, 100vh) scale(0.8829); } }
		.snow:nth-child(146) { opacity: 0.3376; transform: translate(47.8697vw, -10px) scale(0.2425); animation: fall-146 24s -11s linear infinite; }
		@keyframes fall-146 { 51.637% { transform: translate(50.8988vw, 51.637vh) scale(0.2425); } to { transform: translate(49.38425vw, 100vh) scale(0.2425); } }
		.snow:nth-child(147) { opacity: 0.7552; transform: translate(31.0443vw, -10px) scale(0.9003); animation: fall-147 27s -3s linear infinite; }
		@keyframes fall-147 { 63.917% { transform: translate(32.6805vw, 63.917vh) scale(0.9003); } to { transform: translate(31.8624vw, 100vh) scale(0.9003); } }
		.snow:nth-child(148) { opacity: 0.8063; transform: translate(14.4645vw, -10px) scale(0.8875); animation: fall-148 10s -23s linear infinite; }
		@keyframes fall-148 { 78.243% { transform: translate(9.4181vw, 78.243vh) scale(0.8875); } to { transform: translate(11.9413vw, 100vh) scale(0.8875); } }
		.snow:nth-child(149) { opacity: 0.8791; transform: translate(8.4863vw, -10px) scale(0.5798); animation: fall-149 12s -1s linear infinite; }
		@keyframes fall-149 { 44.06% { transform: translate(12.1389vw, 44.06vh) scale(0.5798); } to { transform: translate(10.3126vw, 100vh) scale(0.5798); } }
		.snow:nth-child(150) { opacity: 0.8364; transform: translate(13.9535vw, -10px) scale(0.5464); animation: fall-150 19s -13s linear infinite; }
		@keyframes fall-150 { 53.114% { transform: translate(20.3124vw, 53.114vh) scale(0.5464); } to { transform: translate(17.13295vw, 100vh) scale(0.5464); } }
		.snow:nth-child(151) { opacity: 0.7822; transform: translate(93.9582vw, -10px) scale(0.4237); animation: fall-151 30s -26s linear infinite; }
		@keyframes fall-151 { 58.672% { transform: translate(86.9196vw, 58.672vh) scale(0.4237); } to { transform: translate(90.4389vw, 100vh) scale(0.4237); } }
		.snow:nth-child(152) { opacity: 0.6506; transform: translate(94.5475vw, -10px) scale(0.9624); animation: fall-152 16s -20s linear infinite; }
		@keyframes fall-152 { 45.729% { transform: translate(102.6765vw, 45.729vh) scale(0.9624); } to { transform: translate(98.612vw, 100vh) scale(0.9624); } }
		.snow:nth-child(153) { opacity: 0.8974; transform: translate(9.5319vw, -10px) scale(0.8195); animation: fall-153 28s -29s linear infinite; }
		@keyframes fall-153 { 31.947% { transform: translate(2.2153vw, 31.947vh) scale(0.8195); } to { transform: translate(5.8736vw, 100vh) scale(0.8195); } }
		.snow:nth-child(154) { opacity: 0.3479; transform: translate(52.5036vw, -10px) scale(0.6447); animation: fall-154 14s -17s linear infinite; }
		@keyframes fall-154 { 42.572% { transform: translate(56.7407vw, 42.572vh) scale(0.6447); } to { transform: translate(54.62215vw, 100vh) scale(0.6447); } }
		.snow:nth-child(155) { opacity: 0.5232; transform: translate(10.365vw, -10px) scale(0.2178); animation: fall-155 19s -18s linear infinite; }
		@keyframes fall-155 { 55.932% { transform: translate(15.0941vw, 55.932vh) scale(0.2178); } to { transform: translate(12.72955vw, 100vh) scale(0.2178); } }
		.snow:nth-child(156) { opacity: 0.0568; transform: translate(61.9011vw, -10px) scale(0.8541); animation: fall-156 14s -26s linear infinite; }
		@keyframes fall-156 { 78.435% { transform: translate(52.3031vw, 78.435vh) scale(0.8541); } to { transform: translate(57.1021vw, 100vh) scale(0.8541); } }
		.snow:nth-child(157) { opacity: 0.7915; transform: translate(79.8888vw, -10px) scale(0.9488); animation: fall-157 15s -6s linear infinite; }
		@keyframes fall-157 { 75.681% { transform: translate(78.5557vw, 75.681vh) scale(0.9488); } to { transform: translate(79.22225vw, 100vh) scale(0.9488); } }
		.snow:nth-child(158) { opacity: 0.5088; transform: translate(78.4387vw, -10px) scale(0.9071); animation: fall-158 22s -29s linear infinite; }
		@keyframes fall-158 { 48.051% { transform: translate(75.5686vw, 48.051vh) scale(0.9071); } to { transform: translate(77.00365vw, 100vh) scale(0.9071); } }
		.snow:nth-child(159) { opacity: 0.8389; transform: translate(31.8991vw, -10px) scale(0.2806); animation: fall-159 20s -14s linear infinite; }
		@keyframes fall-159 { 64.584% { transform: translate(40.1999vw, 64.584vh) scale(0.2806); } to { transform: translate(36.0495vw, 100vh) scale(0.2806); } }
		.snow:nth-child(160) { opacity: 0.1408; transform: translate(65.653vw, -10px) scale(0.2663); animation: fall-160 16s -2s linear infinite; }
		@keyframes fall-160 { 75.704% { transform: translate(63.0023vw, 75.704vh) scale(0.2663); } to { transform: translate(64.32765vw, 100vh) scale(0.2663); } }
		.snow:nth-child(161) { opacity: 0.6445; transform: translate(32.2178vw, -10px) scale(0.8763); animation: fall-161 15s -15s linear infinite; }
		@keyframes fall-161 { 65.944% { transform: translate(31.2911vw, 65.944vh) scale(0.8763); } to { transform: translate(31.75445vw, 100vh) scale(0.8763); } }
		.snow:nth-child(162) { opacity: 0.6453; transform: translate(41.2124vw, -10px) scale(0.6675); animation: fall-162 29s -6s linear infinite; }
		@keyframes fall-162 { 51.801% { transform: translate(51.061vw, 51.801vh) scale(0.6675); } to { transform: translate(46.1367vw, 100vh) scale(0.6675); } }
		.snow:nth-child(163) { opacity: 0.8963; transform: translate(39.1391vw, -10px) scale(0.2703); animation: fall-163 22s -20s linear infinite; }
		@keyframes fall-163 { 42.506% { transform: translate(33.0604vw, 42.506vh) scale(0.2703); } to { transform: translate(36.09975vw, 100vh) scale(0.2703); } }
		.snow:nth-child(164) { opacity: 0.6349; transform: translate(89.2083vw, -10px) scale(0.9273); animation: fall-164 20s -10s linear infinite; }
		@keyframes fall-164 { 64.152% { transform: translate(89.6074vw, 64.152vh) scale(0.9273); } to { transform: translate(89.40785vw, 100vh) scale(0.9273); } }
		.snow:nth-child(165) { opacity: 0.7786; transform: translate(21.1441vw, -10px) scale(0.6885); animation: fall-165 22s -20s linear infinite; }
		@keyframes fall-165 { 60.403% { transform: translate(28.722vw, 60.403vh) scale(0.6885); } to { transform: translate(24.93305vw, 100vh) scale(0.6885); } }
		.snow:nth-child(166) { opacity: 0.7075; transform: translate(16.8805vw, -10px) scale(0.0387); animation: fall-166 23s -9s linear infinite; }
		@keyframes fall-166 { 52.244% { transform: translate(25.0463vw, 52.244vh) scale(0.0387); } to { transform: translate(20.9634vw, 100vh) scale(0.0387); } }
		.snow:nth-child(167) { opacity: 0.9463; transform: translate(30.7041vw, -10px) scale(0.9496); animation: fall-167 30s -8s linear infinite; }
		@keyframes fall-167 { 74.461% { transform: translate(29.9542vw, 74.461vh) scale(0.9496); } to { transform: translate(30.32915vw, 100vh) scale(0.9496); } }
		.snow:nth-child(168) { opacity: 0.6941; transform: translate(85.3411vw, -10px) scale(0.6122); animation: fall-168 30s -30s linear infinite; }
		@keyframes fall-168 { 67.726% { transform: translate(83.1062vw, 67.726vh) scale(0.6122); } to { transform: translate(84.22365vw, 100vh) scale(0.6122); } }
		.snow:nth-child(169) { opacity: 0.9142; transform: translate(35.4992vw, -10px) scale(0.3305); animation: fall-169 27s -12s linear infinite; }
		@keyframes fall-169 { 36.219% { transform: translate(40.1847vw, 36.219vh) scale(0.3305); } to { transform: translate(37.84195vw, 100vh) scale(0.3305); } }
		.snow:nth-child(170) { opacity: 0.5258; transform: translate(55.0305vw, -10px) scale(0.7941); animation: fall-170 16s -6s linear infinite; }
		@keyframes fall-170 { 68.143% { transform: translate(64.2497vw, 68.143vh) scale(0.7941); } to { transform: translate(59.6401vw, 100vh) scale(0.7941); } }
		.snow:nth-child(171) { opacity: 0.9813; transform: translate(89.9623vw, -10px) scale(0.896); animation: fall-171 20s -2s linear infinite; }
		@keyframes fall-171 { 45.022% { transform: translate(98.8902vw, 45.022vh) scale(0.896); } to { transform: translate(94.42625vw, 100vh) scale(0.896); } }
		.snow:nth-child(172) { opacity: 0.3217; transform: translate(28.1051vw, -10px) scale(0.265); animation: fall-172 27s -18s linear infinite; }
		@keyframes fall-172 { 45.407% { transform: translate(22.1814vw, 45.407vh) scale(0.265); } to { transform: translate(25.14325vw, 100vh) scale(0.265); } }
		.snow:nth-child(173) { opacity: 0.9196; transform: translate(40.5366vw, -10px) scale(0.304); animation: fall-173 29s -4s linear infinite; }
		@keyframes fall-173 { 49.931% { transform: translate(49.4888vw, 49.931vh) scale(0.304); } to { transform: translate(45.0127vw, 100vh) scale(0.304); } }
		.snow:nth-child(174) { opacity: 0.1941; transform: translate(14.5156vw, -10px) scale(0.66); animation: fall-174 13s -26s linear infinite; }
		@keyframes fall-174 { 65.697% { transform: translate(14.7084vw, 65.697vh) scale(0.66); } to { transform: translate(14.612vw, 100vh) scale(0.66); } }
		.snow:nth-child(175) { opacity: 0.73; transform: translate(67.137vw, -10px) scale(0.3535); animation: fall-175 20s -27s linear infinite; }
		@keyframes fall-175 { 63.026% { transform: translate(65.2954vw, 63.026vh) scale(0.3535); } to { transform: translate(66.2162vw, 100vh) scale(0.3535); } }
		.snow:nth-child(176) { opacity: 0.1725; transform: translate(74.1281vw, -10px) scale(0.8684); animation: fall-176 12s -13s linear infinite; }
		@keyframes fall-176 { 38.459% { transform: translate(83.2444vw, 38.459vh) scale(0.8684); } to { transform: translate(78.68625vw, 100vh) scale(0.8684); } }
		.snow:nth-child(177) { opacity: 0.0884; transform: translate(72.4435vw, -10px) scale(0.5242); animation: fall-177 14s -16s linear infinite; }
		@keyframes fall-177 { 72.732% { transform: translate(78.0574vw, 72.732vh) scale(0.5242); } to { transform: translate(75.25045vw, 100vh) scale(0.5242); } }
		.snow:nth-child(178) { opacity: 0.5548; transform: translate(66.6157vw, -10px) scale(0.7485); animation: fall-178 19s -2s linear infinite; }
		@keyframes fall-178 { 46.308% { transform: translate(72.832vw, 46.308vh) scale(0.7485); } to { transform: translate(69.72385vw, 100vh) scale(0.7485); } }
		.snow:nth-child(179) { opacity: 0.4596; transform: translate(9.7737vw, -10px) scale(0.6661); animation: fall-179 15s -9s linear infinite; }
		@keyframes fall-179 { 71.648% { transform: translate(14.1592vw, 71.648vh) scale(0.6661); } to { transform: translate(11.96645vw, 100vh) scale(0.6661); } }
		.snow:nth-child(180) { opacity: 0.9644; transform: translate(38.7828vw, -10px) scale(0.0304); animation: fall-180 17s -24s linear infinite; }
		@keyframes fall-180 { 38.191% { transform: translate(48.402vw, 38.191vh) scale(0.0304); } to { transform: translate(43.5924vw, 100vh) scale(0.0304); } }
		.snow:nth-child(181) { opacity: 0.3097; transform: translate(10.3169vw, -10px) scale(0.9968); animation: fall-181 21s -1s linear infinite; }
		@keyframes fall-181 { 69.022% { transform: translate(18.1822vw, 69.022vh) scale(0.9968); } to { transform: translate(14.24955vw, 100vh) scale(0.9968); } }
		.snow:nth-child(182) { opacity: 0.3197; transform: translate(86.9913vw, -10px) scale(0.0127); animation: fall-182 23s -11s linear infinite; }
		@keyframes fall-182 { 74.361% { transform: translate(89.778vw, 74.361vh) scale(0.0127); } to { transform: translate(88.38465vw, 100vh) scale(0.0127); } }
		.snow:nth-child(183) { opacity: 0.8749; transform: translate(63.4805vw, -10px) scale(0.8622); animation: fall-183 27s -6s linear infinite; }
		@keyframes fall-183 { 79.88% { transform: translate(65.2025vw, 79.88vh) scale(0.8622); } to { transform: translate(64.3415vw, 100vh) scale(0.8622); } }
		.snow:nth-child(184) { opacity: 0.3816; transform: translate(62.08vw, -10px) scale(0.1666); animation: fall-184 25s -29s linear infinite; }
		@keyframes fall-184 { 31.667% { transform: translate(54.6606vw, 31.667vh) scale(0.1666); } to { transform: translate(58.3703vw, 100vh) scale(0.1666); } }
		.snow:nth-child(185) { opacity: 0.7753; transform: translate(32.056vw, -10px) scale(0.0513); animation: fall-185 19s -8s linear infinite; }
		@keyframes fall-185 { 53.439% { transform: translate(37.9412vw, 53.439vh) scale(0.0513); } to { transform: translate(34.9986vw, 100vh) scale(0.0513); } }
		.snow:nth-child(186) { opacity: 0.7084; transform: translate(67.7104vw, -10px) scale(0.4076); animation: fall-186 14s -19s linear infinite; }
		@keyframes fall-186 { 56.651% { transform: translate(58.6494vw, 56.651vh) scale(0.4076); } to { transform: translate(63.1799vw, 100vh) scale(0.4076); } }
		.snow:nth-child(187) { opacity: 0.137; transform: translate(94.7025vw, -10px) scale(0.8572); animation: fall-187 14s -19s linear infinite; }
		@keyframes fall-187 { 37.051% { transform: translate(86.1061vw, 37.051vh) scale(0.8572); } to { transform: translate(90.4043vw, 100vh) scale(0.8572); } }
		.snow:nth-child(188) { opacity: 0.3545; transform: translate(67.3505vw, -10px) scale(0.8251); animation: fall-188 29s -21s linear infinite; }
		@keyframes fall-188 { 57.747% { transform: translate(72.3147vw, 57.747vh) scale(0.8251); } to { transform: translate(69.8326vw, 100vh) scale(0.8251); } }
		.snow:nth-child(189) { opacity: 0.9138; transform: translate(48.547vw, -10px) scale(0.4831); animation: fall-189 16s -5s linear infinite; }
		@keyframes fall-189 { 56.221% { transform: translate(50.8059vw, 56.221vh) scale(0.4831); } to { transform: translate(49.67645vw, 100vh) scale(0.4831); } }
		.snow:nth-child(190) { opacity: 0.077; transform: translate(17.8307vw, -10px) scale(0.7358); animation: fall-190 19s -19s linear infinite; }
		@keyframes fall-190 { 56.6% { transform: translate(19.161vw, 56.6vh) scale(0.7358); } to { transform: translate(18.49585vw, 100vh) scale(0.7358); } }
		.snow:nth-child(191) { opacity: 0.9365; transform: translate(70.9588vw, -10px) scale(0.113); animation: fall-191 14s -3s linear infinite; }
		@keyframes fall-191 { 69.155% { transform: translate(74.2603vw, 69.155vh) scale(0.113); } to { transform: translate(72.60955vw, 100vh) scale(0.113); } }
		.snow:nth-child(192) { opacity: 0.8704; transform: translate(49.9104vw, -10px) scale(0.6865); animation: fall-192 28s -30s linear infinite; }
		@keyframes fall-192 { 40.778% { transform: translate(52.6806vw, 40.778vh) scale(0.6865); } to { transform: translate(51.2955vw, 100vh) scale(0.6865); } }
		.snow:nth-child(193) { opacity: 0.4508; transform: translate(50.5495vw, -10px) scale(0.7816); animation: fall-193 13s -16s linear infinite; }
		@keyframes fall-193 { 50.811% { transform: translate(57.6689vw, 50.811vh) scale(0.7816); } to { transform: translate(54.1092vw, 100vh) scale(0.7816); } }
		.snow:nth-child(194) { opacity: 0.3531; transform: translate(0.6868vw, -10px) scale(0.5219); animation: fall-194 16s -4s linear infinite; }
		@keyframes fall-194 { 46.607% { transform: translate(-2.8067vw, 46.607vh) scale(0.5219); } to { transform: translate(-1.05995vw, 100vh) scale(0.5219); } }
		.snow:nth-child(195) { opacity: 0.5901; transform: translate(95.667vw, -10px) scale(0.7067); animation: fall-195 20s -10s linear infinite; }
		@keyframes fall-195 { 39.43% { transform: translate(89.1035vw, 39.43vh) scale(0.7067); } to { transform: translate(92.38525vw, 100vh) scale(0.7067); } }
		.snow:nth-child(196) { opacity: 0.0958; transform: translate(14.4315vw, -10px) scale(0.8617); animation: fall-196 23s -6s linear infinite; }
		@keyframes fall-196 { 53.335% { transform: translate(17.1779vw, 53.335vh) scale(0.8617); } to { transform: translate(15.8047vw, 100vh) scale(0.8617); } }
		.snow:nth-child(197) { opacity: 0.4968; transform: translate(40.0268vw, -10px) scale(0.281); animation: fall-197 13s -15s linear infinite; }
		@keyframes fall-197 { 49.755% { transform: translate(30.5176vw, 49.755vh) scale(0.281); } to { transform: translate(35.2722vw, 100vh) scale(0.281); } }
		.snow:nth-child(198) { opacity: 0.829; transform: translate(90.1693vw, -10px) scale(0.9873); animation: fall-198 18s -12s linear infinite; }
		@keyframes fall-198 { 43.934% { transform: translate(81.439vw, 43.934vh) scale(0.9873); } to { transform: translate(85.80415vw, 100vh) scale(0.9873); } }
		.snow:nth-child(199) { opacity: 0.5618; transform: translate(11.126vw, -10px) scale(0.6256); animation: fall-199 10s -20s linear infinite; }
		@keyframes fall-199 { 77.389% { transform: translate(10.8733vw, 77.389vh) scale(0.6256); } to { transform: translate(10.99965vw, 100vh) scale(0.6256); } }
		.snow:nth-child(200) { opacity: 0.4506; transform: translate(82.4784vw, -10px) scale(0.3572); animation: fall-200 20s -25s linear infinite; }
		@keyframes fall-200 { 43.774% { transform: translate(77.7924vw, 43.774vh) scale(0.3572); } to { transform: translate(80.1354vw, 100vh) scale(0.3572); } }
		</style>
<?php
}