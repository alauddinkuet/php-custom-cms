<div id="main">
	<form action="main/insertRow" method="post">
		<input type="text" name="text" />
		<input type="submit" value="Insert" />
	</form>
	<table>
		<thead>
			<tr>
				<?php

				/** Build headers */

				$keys = array_keys($this -> tableData[0]);
				foreach ($keys as $key => $val) {
					echo "<th id='$val'>" . trim($val) . "</th>";
				}
				?>
			<th></th></tr>
		</thead>
		<?php
		foreach ($this->tableData as $key => $row) {

			echo '<tr id="' . $row['id'] . '">';

			foreach ($row as $key => $val) {

				echo '<td><span>' . $val . '</span></td>';

			}

			echo '<td class="delete"> </td>';
			echo '</tr>';

		}
		?>
	</table>
</div>
