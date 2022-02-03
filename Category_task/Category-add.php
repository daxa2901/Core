
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


  input[type=text],select,input[type=number],input[type=float],input[type=date]{
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

  .cancelbtn
  {
    background-color: red;
  }
  .container {
    padding: 16px;
  }


</style>
</head>
<body>
  <form action="Category-save.php" method="post" >
    <div class="container">

	 
      <label for="name"><b>Name</b></label><br>
      <input type="text" placeholder="Enter Category Name" name="name" required><br>

      <label for="price"><b>Price</b></label><br>
      <input type="float" placeholder="Enter Category Price" name="price" required><br>

      <label for="quantity"><b>Quantity</b></label><br>
      <input type="number" placeholder="Enter Category Quantity" name="quantity" required><br>

      
      <label for="Status"><b>Status</b></label><br>
      <select name="status">
        <option value=1>InActive</option>
        <option value=2>Active</option>
      </select>

      <button type="submit" class="Registerbtn" value="Register" name="add">Add</button>
     <a href = 'Category-grid.php'><button type="button" class="cancelbtn" value="Cancel" name="cancel">Cancel</button></a>
    </div>
  </form>
  </body>
  </html>