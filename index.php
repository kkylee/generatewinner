<!DOCTYPE html>
<html>
<head>
	<title>Raffle</title>
	<!-- Bootstrap Style -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<br/>
	<div class="col-md-12">
		<em> Note : This is just a front end system. No database included.</em>
		<br/>
		<em> Technologies: HTML CSS (Bootstrap 4) and Javascript (Jquery 3.4.1)</em>
		<br/>
		<br/>

		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<form id="form">
					<label>Name :</label>
					<input type="text" id="name" class="form-control">
					<button class="btn btn-primary mt-1 float-right btn-sm" type="submit">Add</button>
					</form>
				</div>
			</div>
			<div class="col-md-2">
				<label>Pool :</label>
					<ul id="stacks">
					</ul>
			</div>
			<div class="col-md-3 text-center">
				<em> Note : Generating winners has 2 sec interval.</em><br/>
				<button class="btn btn-primary btn-lg mt-3" type="button" id="generate" disabled>Generate</button>
			</div>
			<div class="col-md-2">
				<label>Winners :</label>
					<ol id="winners"></ol>
			</div>
		</div>
	</div>
</body>

<!-- Bootstrap Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
	var stacks = [];
	var loader = '<div class="spinner-border" role="status">'
				    +'<span class="sr-only">Loading...</span>'
				  +'</div>';

	$(function(){
		$('#form').on('submit', function(e){
			e.preventDefault();
			e.stopImmediatePropagation();

			var name = $.trim($('#name').val());

			if(name != ""){
				if($.inArray(name,stacks) != -1){
					alert(`${name} is already exist in the pool.`);
				}else{
					addToStacks(name);
				}
			}else{
				alert('Name field is required');
				$('#name').val('');
			}
			
		})

		$('#generate').click(function(e){
			e.stopImmediatePropagation();

				$('#generate').attr('disabled','disabled');
				$('#generate').text('Generating..');
				generateWinners();
		})

	})

	function generateWinners(){
		var inter = setInterval(function(){
				
				var min = 0;
				var max = stacks.length;
				if(max > 0){
					var random = Math.floor(Math.random() * (max - min)) + min;
					name = stacks[random];
					addToWinners(name);
				}else{
				    $('#generate').text('Generate');
					clearInterval(inter);
					alert('Winners has been generated');
				}
			},2000);
	}

	function addToStacks(name){
		$('#stacks').append(`<li class="${name.replace(" ","-")}">${name} <i class="	glyphicon glyphicon-trash"></i></li>`);

		stacks.push(name);

		$('#name').val('');
		$('#generate').attr('disabled',false);
	}

	function removeToStacks(name){
		$(`.${name.replace(" ","-")}`).remove();

		//remove user from the pools
		stacks = $.grep(stacks,function(val){
			return val != name;
		});

		if(stacks.length == 0){
			$('#generate').attr('disabled','disabled');
		}
	}

	function addToWinners(name){
		removeToStacks(name);
		$('#winners').append(`<li class="${name.replace(" ","-")}">${name}</i></li>`);
	}




</script>

</html>