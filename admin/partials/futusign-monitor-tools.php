<?php
/**
 * Tools screen
 *
 * @link       https://bitbucket.org/futusign/futusign-wp-monitor
 * @since      0.1.0
 *
 * @package    futusign_monitor
 * @subpackage futusign_monitor/admin/partials
 */
if ( ! defined( 'WPINC' ) ) {
	 die;
}
/**
 * Tools screen
 *
 * @since    0.1.0
 */
function futusign_monitor_tools() {
	// MONITOR
	$keys = array( 'api_key', 'auth_domain', 'database_url', 'storage_bucket', 'messaging_sender_id', 'email', 'password' );
	$outputKeys = array( 'apiKey', 'authDomain', 'databaseURL', 'storageBucket', 'messagingSenderId', 'email', 'password' );
	$options = get_option( 'futusign_monitor_option_name' );
	// SCREENS
	$screens = array();
	$args = array(
		'post_type' => 'futusign_screen',
		'posts_per_page' => -1,
	);
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) {
		$loop->the_post();
		$screens[] = array(
			'id' => get_the_ID(),
			'title' => get_the_title(),
		);
	}
	wp_reset_query();
?>
	<script>
		window.monitor = {
			<?php
				for ($i = 0; $i < sizeOf($keys); $i++) {
					$key = $keys[$i];
					$outputKey = $outputKeys[$i];
					echo ' ' . $outputKey . ': ' . json_encode($options[$key]);
					if ($i != sizeOf($keys) - 1) echo ',';
				}
			?>
		};
		window.screens = <?php echo json_encode( $screens ); ?>;
	</script>
  <style>
		.futusign_monitor_tools_status {
			display: inline-block;
			margin-left: 8px;
			border-radius: 7.5px;
			width: 15px;
			height: 15px;
		}
		.futusign_monitor_tools_up {
			display: inline-block;
			margin-left: 8px;
			border-left: 10px solid transparent;
			border-right: 10px solid transparent;
			border-bottom: 15px solid #5cb85c;
			width: 0px;
			height: 0px;
		}
		.futusign_monitor_tools_down {
			display: inline-block;
			margin-left: 8px;
			border-left: 10px solid transparent;
			border-right: 10px solid transparent;
			border-top: 15px solid #d9534f;
			width: 0px;
			height: 0px;
		}
		table.futusign_monitor_tools_fixed {
    	table-layout: fixed;
		}
		table.futusign_monitor_tools_widefat {
    	background: #fff;
    	border: 1px solid #e5e5e5;
    	-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.04);
    	box-shadow: 0 1px 1px rgba(0,0,0,.04);
		  border-spacing: 0;
		  width: 100%;
		  clear: both;
		  margin: 0;
		}
		.futusign_monitor_tools_widefat .futusign_monitor_tools_check-column {
		    width: 2.2em;
		    padding: 6px 0 25px;
		    vertical-align: top;
		}

		.futusign_monitor_tools_widefat thead tr th {
		    color: #32373c;
		}
		.futusign_monitor_tools_widefat tfoot td, .futusign_monitor_tools_widefat tfoot th, .futusign_monitor_tools_widefat thead td, .futusign_monitor_tools_widefat thead th {
		    line-height: 1.4em;
		}
		.futusign_monitor_tools_widefat thead td, .futusign_monitor_tools_widefat thead th {
		    border-bottom: 1px solid #e1e1e1;
		}
		.futusign_monitor_tools_widefat td, .futusign_monitor_tools_widefat th {
		    color: #555;
		}
		.futusign_monitor_tools_widefat tfoot td, .futusign_monitor_tools_widefat th, .futusign_monitor_tools_widefat thead td {
		    font-weight: 400;
		}
		.futusign_monitor_tools_widefat tfoot td, .futusign_monitor_tools_widefat th, .futusign_monitor_tools_widefat thead td {
		    text-align: left;
		    line-height: 1.3em;
		    font-size: 14px;
		}
		.futusign_monitor_tools_widefat td, .futusign_monitor_tools_widefat th {
		    padding: 8px 10px;
		}
		.futusign_monitor_tools_striped>tbody>:nth-child(odd) {
    	background-color: #f9f9f9;
		}
		.futusign_monitor_tools_widefat tbody th.futusign_monitor_tools_check-column, .futusign_monitor_tools_widefat head td.futusign_monitor_tools_check-column {
    	padding: 11px 0 0 3px;
		}
	</style>
	<div id="futusign_monitor_tools" class="wrap">
		<h1>futusign Monitor Tools</h1>
		<h2>Screens Status (as of <span id="futusign_monitor_tools__time"></span>)</h2>
		<table class="futusign_monitor_tools_widefat futusign_monitor_tools_fixed futusign_monitor_tools_striped">
			<thead>
				<tr>
					<th class="futusign_monitor_tools_check-column"></th>
					<th>Title</th>
				</tr>
			<thead>
			<tbody id="futusign_monitor_tools__status">
			</tbody>
		</table>
		<h2>Screens History</h2>
		<table class="futusign_monitor_tools_widefat futusign_monitor_tools_fixed futusign_monitor_tools_striped">
			<thead>
				<tr>
					<th class="futusign_monitor_tools_check-column"></th>
					<th>Title</th>
					<th>Timestamp</th>
				</tr>
			<thead>
			<tbody id="futusign_monitor_tools__history">
			</tbody>
		</table>
	</div>
	<script src="https://www.gstatic.com/firebasejs/3.7.3/firebase.js"></script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var indicatorElsById = {};
			var timeEl = document.getElementById('futusign_monitor_tools__time');
			textEl = document.createTextNode((new Date()).toString());
			timeEl.appendChild(textEl);
			var statusEl = document.getElementById('futusign_monitor_tools__status');
			var historyEl = document.getElementById('futusign_monitor_tools__history');
			for (var i = 0; i < window.screens.length; i += 1) {
				var screen = screens[i];
				var rowEl = document.createElement("tr");
				var columnEl = document.createElement("th");
				columnEl.className = 'futusign_monitor_tools_check-column';
				var indicatorEl = document.createElement('div');
				indicatorElsById[screen.id] = indicatorEl;
				indicatorEl.className = 'futusign_monitor_tools_status';
				indicatorEl.style.backgroundColor = '#999';
				columnEl.appendChild(indicatorEl);
				rowEl.appendChild(columnEl);
				columnEl = document.createElement("td");
				textEl = document.createTextNode(screen.title);
				columnEl.appendChild(textEl);
				rowEl.appendChild(columnEl);
				statusEl.appendChild(rowEl);
			}
			try {
				firebase.initializeApp(monitor);
				firebase.auth().onAuthStateChanged(function(user) {
					if (!user) {
						firebase.auth().signInWithEmailAndPassword(
							monitor.email,
							monitor.password
						);
					} else {
						var logs = [];
						var presenceRef = firebase.database().ref('presence');
						var logRef = firebase.database().ref('log').orderByChild('timestamp');
						presenceRef.once('value')
  					.then(function(snapshot) {
							for (var i = 0; i < window.screens.length; i += 1) {
								var screen = screens[i];
								indicatorElsById[screen.id].style.backgroundColor = '#d9534f';
							}
    					snapshot.forEach(function(childSnapshot) {
      					var childData = childSnapshot.val();
								indicatorElsById[childData].style.backgroundColor = '#5cb85c';
							});
						});
						logRef.once('value')
						.then(function(snapshot) {
    					snapshot.forEach(function(childSnapshot) {
								logs.push(childSnapshot.val());
							});
							logs.sort((a, b) => b.timestamp - a.timestamp);
							for (var i = 0; i < logs.length; i += 1) {
								var log = logs[i];
								var rowEl = document.createElement("tr");
								var columnEl = document.createElement("th");
								columnEl.className = 'futusign_monitor_tools_check-column';
								var indicatorEl = document.createElement('div');
								indicatorElsById[screen.id] = indicatorEl;
								indicatorEl.className = log.status === 'up' ?
									'futusign_monitor_tools_up' :
									'futusign_monitor_tools_down';
								columnEl.appendChild(indicatorEl);
								rowEl.appendChild(columnEl);
								columnEl = document.createElement("td");
								textEl = document.createTextNode(log.title);
								columnEl.appendChild(textEl);
								rowEl.appendChild(columnEl);
								columnEl = document.createElement("td");
								textEl = document.createTextNode((new Date(log.timestamp)).toString());
								columnEl.appendChild(textEl);
								rowEl.appendChild(columnEl);
								historyEl.appendChild(rowEl);
							}
						});
					}
				});
			} catch (err) {
				// DO NOTHING
			}
		});
	</script>
	<?php
}
futusign_monitor_tools();
