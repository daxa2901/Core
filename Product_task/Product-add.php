
<html>
<head>
<style>
 
  form {
    
    width: 350px;
    background-color:#f1f1f1;
    margin-left: 500px;
    margin-top: 50px;
    padding-left: 10px;
  }


  input[type=text],select,input[type=number],input[type=date]{
    width: 300px;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;

  }

 
  button {
    
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 85px;
  }

   
    button:hover {
    opacity: 0.8;
  }

  .Registerbtn
  {
    background-color: green;
  }

  .cancelbtn {
    
    
    background-color: #f44336;
    margin-left: 10px;
  }

  .container {
    padding: 16px;
  }

  
  
  }
</style>
</head>
<body>
  <form action="Product-save.php" method="post" >
    <div class="container">

	 <label for="eid"><b>ID</b></label><br>
      <input type="number" placeholder="Enter Product id" name="id" required><br>

      <label for="name"><b>Name</b></label><br>
      <input type="text" placeholder="Enter Product Name" name="name" required><br>

      <label for="price"><b>Price</b></label><br>
      <input type="number" placeholder="Enter Product Price" name="price" required><br>

      <label for="quantity"><b>Quantity</b></label><br>
      <input type="number" placeholder="Enter Product Quantity" name="quantity" required><br>

      <label for="created Date"><b>created At</b></label><br>
      <input type="date" placeholder="Enter created date"  name="createdAt" required><br>

      <label for="updated Date"><b>update At</b></label><br>
      <input type="date" placeholder="Enter updated date"  name="updatedAt" required><br>

      <label for="Status"><b>Status</b></label><br>
      <select name="status">
        <option value=1>1</option>
        <option value=2>2</option>
      </select>

      <button type="submit" class="Registerbtn" value="Register" name="add">Register</button>
      <button type="button" class="cancelbtn" name = 'cancel'>Cancel</button>
     
    </div>
  </form>
  </body>
  </html>