<!DOCTYPE html>
<html>
<head>
  <title>create</title>
  <!-- bs.css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <style type ="text/css">

   </style>
</head>
<body class="bg-secondary">
	<nav class="navbar navbar-light bg-light mb-5">
  		<a class="navbar-brand" href="index.php">
    	Huggy Bear Adoption
  		</a>
	</nav>

  	<div class="container-fluid">
		<!-- form for creating a new animal -->
  		<form action="actions/a_create.php" method="post">
			<div class="form-row">
				<div class="form-group col-md-6">
				<label for="inputName">Name</label>
				<input type="text" name="name" class="form-control" id="inputName">
				</div>
				<div class="form-group col-md-6">
					<label for="inputAge">Age</label>
					<input type="text" name="age" class="form-control" id="inputAge">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="inputSpecies">Species</label>
					<input type="text" name="species" class="form-control" id="inputSpecies">
				</div>
				<div class="form-group col-md-4">
					<label for="inputBreed">Breed</label>
					<input type="text" name="breed" class="form-control" id="inputBreed">
				</div>
				<div class="form-group col-md-4">
					<label for="inputSize">Size</label>
					<input type="text" name="size" class="form-control" id="inputSize">
				</div>
			</div>
			<div class="form-group">
				<label for="inputDescription">Description</label>
				<textarea class="form-control" name="description" id="inputDescription" rows="3"></textarea>
			</div>
			<div class="form-group">
			<label for="inputImage">Image URL</label>
			<input type="text" name="image" class="form-control" id="inputImage">
			</div>
			<div class="form-group">
			<label for="inputLocation">Location</label>
			<input type="text" name="location" class="form-control" id="inputLocation">
			</div>
			<div class="form-group">
			<label for="inputHobbies">Hobbies</label>
			<input type="text" name="hobbies" class="form-control" id="inputHobbies">
			</div>
			<button type="submit" class="btn btn-primary">Save Changes</button>
  		</form>
  	</div>
</body>
</html>