<h2>Delete Item</h2>

<p>Are you sure you want to delete the category?</p>

<?php

echo form_open($form_location);

echo form_submit('submit', 'Yes - Delete Category');

echo nbs(7);

echo form_submit('submit', 'No - Cancel');

echo form_close();

?>