<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" type="text/css" href="./style.css"> -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
	<script type="text/javascript" src="skin/admin/js/jQuery.js"></script>
	<script type="text/javascript" src="skin/admin/js/admin.js"></script>
	<title><?php echo $this->getTitle() ?></title>

	<script type="text/javascript">
		core = {
			config:{
				data : [],
				form : null,
				setData : function(data){
					this.data = data;
					return this;
				},
				getData : function(){
					return this.data;
				},
				
				setForm : function(form){
					this.form = $(form);
					return this;
				},
				getForm : function(){
					return this.form;
				},
				validate : function(){
					var canSubmit = true;
					if(!jQuery("#name").val()){
						alert("please enter name");
						canSubmit = false;
					}
					if(!jQuery("#code").val()){
						alert("please enter code");
						canSubmit = false;
					}
					if(!jQuery("#Value").val()){
						alert("please enter value");
						canSubmit = false;
					}
					if(canSubmit == true){
						this.callAjax();
					}
					return false;
				},
				callAjax : function(){
					$.ajax({
					  type: jQuery("#form-data").attr('method'),
					  url: jQuery("#form-data").attr('action') ,
					  data:  jQuery("#form-data").serialize(),
					  success: function(data) {
					  	$('#layout').load("<?php echo $this->getUrl('grid');?>");
					},
					dataType: "json"
					});
				},

				addNew : function(){
					 $.ajax({
					  type:jQuery("#addNew").attr('method'),
				 	  url: jQuery("#addNew").attr('action'),
					  success: function(data) {
					  	$('#layout').html(data);
					},
					dataType :'html'
					});
				},
				
				getData : function(){

					$.ajax({
					  type:'GET',
				 	  url: '<?php echo $this->getUrl('grid','config');?>',
					  success: function(data) {
					  	// $('#layout').html(data);
					},
					dataType :'html'
					});
				},
				
			}
		}

	</script>
</head>

