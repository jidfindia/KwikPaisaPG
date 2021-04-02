<!DOCTYPE html>
<html>
<body>
<h2>Test Form</h2>
<form action="process.php" method="post">
  <label for="fname">Name:</label>
  <input type="text" name="CUST_NAME" value="John Doe"><br>
  <label for="lname">Email:</label><br>
  <input type="text" name="CUST_EMAIL" value="example@demo.com"><br>
	 <label for="lname">Mobile:</label>
  <input type="text" name="CUST_MOBILE" value="9876543210"><br>
	 <label for="lname">Addrees Line 1:</label>
  <input type="text" name="CUST_ADDRESS_LINE1" value="E57- Sector 63"><br>
	 <label for="lname">Address Line 2:</label>
  <input type="text" name="CUST_ADDRESS_LINE2" value="Gautam Buddha Nagar"><br>
	 <label for="lname">City:</label>
  <input type="text" name="CUST_ADDRESS_CITY" value="Noida"><br>
	<label for="lname">State:</label>
  <input type="text" name="CUST_ADDRESS_STATE" value="UP"><br>
	<label for="lname">Country:</label>
  <input type="text"  name="CUST_ADDRESS_COUNTRY" value="IN"><br>
	<label for="lname">PinCode/Zip Code:</label>
  <input type="text" name="CUST_ADDRESS_POSTAL_CODE" value="102103"><br>
	<label for="lname">Amount:</label>
  <input type="text"  name="TXN_AMOUNT" value="2"><br>
	<label for="lname">Order ID:</label>
  <input type="text"  name="ORDER_ID" value="<?php echo rand(0000,99999);?>">
  <button type="submit">Submit</button>
</form> 
</body>
</html>
