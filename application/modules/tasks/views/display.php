<h1>Your Tasks</h1>

<?php

echo anchor('tasks/create/', '<p>create new task</p>');

foreach ($query->result() as $row) {

			$edit_url = base_url() . 'tasks/create/'. $row->id;
			
			echo "<h2>" . $row->title . " &nbsp; &nbsp; <a href='" . $edit_url . "'>Edit</a></h2>";

		}

		echo "<hr>";


		$this->load->module('nofun');

		$firstname = "Alan";

		$lastname = "Wilson";

		$this->nofun->sayHello($firstname, $lastname);

		echo "<hr>";

		echo Modules::run('nofun/sayHello', $firstname, $lastname);
?>
