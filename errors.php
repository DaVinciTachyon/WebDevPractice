<!-- Allows the collection of errors, which are then printed together -->
<?php  if (count($errors) > 0) : ?>
  <div class="error">
    <!-- cycle through all the errors -->
  	<?php foreach ($errors as $error) : ?>
      <!--print an error -->
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
