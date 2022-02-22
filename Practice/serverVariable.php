<?php
		echo 'file SCRIPT_FILENAME  ==>  ';
		print_r($_SERVER['PHP_SELF']); 

		echo '<br> version of CGI ==>  ';
		print_r($_SERVER['GATEWAY_INTERFACE']);

		echo '<br> IP address of HOST server  ==> ';
		print_r($_SERVER['SERVER_ADDR']);
		
		echo '<br> Name of host server ==>  ';
		print_r($_SERVER['SERVER_NAME']);
		
		echo '<br> Server identification string  ==>  ';
		print_r($_SERVER['SERVER_SOFTWARE']);	

		echo '<br> Name and revisionof the information protocol  ==>  ';
		print_r($_SERVER['SERVER_PROTOCOL']);	

		echo '<br>method used to access the page  ==>  ';
		print_r($_SERVER['REQUEST_METHOD']);	

		echo '<br>timestamp of the start of the request  ==>  ';
		print_r($_SERVER['REQUEST_TIME']);

		echo '<br> query string if the page is accessed via a query string  ==>  ';
		print_r($_SERVER['QUERY_STRING']);	

		echo '<br>Accept header from the current request  ==>  ';
		print_r($_SERVER['HTTP_ACCEPT']);	

		echo '<br>Accept_Charset header from the current request  ==>  ';
		print_r($_SERVER['HTTP_ACCEPT_CHARSET']);	

		echo "<br> Host header from the current request  ==>  ";
		print_r($_SERVER['HTTP_HOST']);	

		echo '<br>  complete URL of the current page  ==>  ';
		print_r($_SERVER['HTTP_REFERER']);	
		
		echo '<br>';
		print_r($_SERVER['HTTPS']);	
		
		echo '<br> IP address from where the user is viewing the current page  ==>  ';
		print_r($_SERVER['REMOTE_ADDR']);	
		
		echo '<br>  Host name from where the user is viewing the current page  ==>  ';
		print_r($_SERVER['REMOTE_HOST']);	
		
		echo '<br> Host name from where the user is viewing the current page  ==>  ';
		print_r($_SERVER['REMOTE_PORT']);	
		
		echo '<br> absolute pathname of the currently executing script  ==>  ';
		print_r($_SERVER['SCRIPT_FILENAME']);	
		
		echo '<br> value given to the SERVER_ADMIN directive in the web server configuration file  ==>  ';
		print_r($_SERVER['SERVER_ADMIN']);	
		
		echo '<br> port on the server machine being used by the web server for communication   ==>  ';
		print_r($_SERVER['SERVER_PORT']);	
		
		echo '<br>  server version and virtual host name which are added to server-generated pages  ==>  ';
		print_r($_SERVER['SERVER_SIGNATURE']);	
		
		echo '<br>  file system based path to the current script  ==>  ';
		print_r($_SERVER['PATH_TRANSLATED']);	
		
		echo '<br>  path of the current script  ==>  ';
		print_r($_SERVER['SCRIPT_NAME']);	
		
		echo '<br> URI of the current page  ==>  ';
		print_r($_SERVER['SCRIPT_URI']);	

?>
