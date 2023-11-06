
<?php
$pdo = new PDO("mysql:host=your_host;dbname=your_database", "your_username", "your_password");


//task 1
$query = "SELECT customers.customer_id, customers.customer_name, COUNT(orders.order_id) AS total_orders
          FROM customers
          LEFT JOIN orders ON customers.customer_id = orders.customer_id
          GROUP BY customers.customer_id, customers.customer_name
          ORDER BY total_orders DESC";

$result = $pdo->query($query);

while ($row = $result->fetch()) {
    echo "Customer ID: " . $row['customer_id'] . ", Customer Name: " . $row['customer_name'] . ", Total Orders: " . $row['total_orders'] . "<br>";
}


//task 2
$query = "SELECT order_items.order_id, products.product_name, order_items.quantity, order_items.quantity * products.price AS total_amount
          FROM order_items
          JOIN products ON order_items.product_id = products.product_id
          ORDER BY order_items.order_id ASC";

$result = $pdo->query($query);

while ($row = $result->fetch()) {
    echo "Order ID: " . $row['order_id'] . ", Product Name: " . $row['product_name'] . ", Quantity: " . $row['quantity'] . ", Total Amount: " . $row['total_amount'] . "<br>";
}


//task 3
$query = "SELECT categories.category_name, SUM(products.price * order_items.quantity) AS total_revenue
          FROM products
          JOIN order_items ON products.product_id = order_items.product_id
          JOIN categories ON products.category_id = categories.category_id
          GROUP BY categories.category_name
          ORDER BY total_revenue DESC";

$result = $pdo->query($query);

while ($row = $result->fetch()) {
    echo "Category Name: " . $row['category_name'] . ", Total Revenue: " . $row['total_revenue'] . "<br>";
}


//task 4
$query = "SELECT customers.customer_name, SUM(products.price * order_items.quantity) AS total_purchase_amount
          FROM customers
          JOIN orders ON customers.customer_id = orders.customer_id
          JOIN order_items ON orders.order_id = order_items.order_id
          JOIN products ON order_items.product_id = products.product_id
          GROUP BY customers.customer_name
          ORDER BY total_purchase_amount DESC
          LIMIT 5";

$result = $pdo->query($query);

while ($row = $result->fetch()) {
    echo "Customer Name: " . $row['customer_name'] . ", Total Purchase Amount: " . $row['total_purchase_amount'] . "<br>";
}



?>