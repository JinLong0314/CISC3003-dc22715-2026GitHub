<?php

include 'includes/book-utilities.inc.php';

$customers = readCustomers('data/customers.txt');

$selectedCustomer = null;
$orders = array();

if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
    foreach ($customers as $customer) {
        if ($customer['id'] == $customer_id) {
            $selectedCustomer = $customer;
            break;
        }
    }
    if ($selectedCustomer !== null) {
        $orders = readOrders($customer_id, 'data/orders.txt');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>DC227153 LEONG CHI LONG</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-design-lite@1.3.0/dist/material.blue_grey-orange.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/demo-styles.css">
    
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/material-design-lite@1.3.0/material.min.js"></script>
    <script src="js/jquery.sparkline.2.1.2.js"></script>
    
  
</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">

            <div class="mdl-grid">

              <!-- mdl-cell + mdl-card: Customers Table -->
              <div class="mdl-cell mdl-cell--7-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Customers</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <table class="mdl-data-table  mdl-shadow--2dp">
                      <thead>
                        <tr>
                          <th class="mdl-data-table__cell--non-numeric">Name</th>
                          <th class="mdl-data-table__cell--non-numeric">University</th>
                          <th class="mdl-data-table__cell--non-numeric">City</th>
                          <th>Sales</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($customers as $c): ?>
                        <tr>
                          <td class="mdl-data-table__cell--non-numeric">
                            <a href="cisc3003-sugex10-after.php?customer_id=<?php echo htmlspecialchars($c['id']); ?>">
                              <?php echo htmlspecialchars($c['first_name'] . ' ' . $c['last_name']); ?>
                            </a>
                          </td>
                          <td class="mdl-data-table__cell--non-numeric"><?php echo htmlspecialchars($c['university']); ?></td>
                          <td class="mdl-data-table__cell--non-numeric"><?php echo htmlspecialchars($c['city']); ?></td>
                          <td><span class="inlinesparkline"><?php echo htmlspecialchars($c['sales']); ?></span></td>
                        </tr>
                        <?php endforeach; ?>                      
                      </tbody>
                    </table>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->
              
              
            <div class="mdl-grid mdl-cell--5-col">
    
                  <!-- mdl-cell + mdl-card: Customer Details -->
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Customer Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <?php if ($selectedCustomer !== null): ?>
                        <h4><?php echo htmlspecialchars($selectedCustomer['first_name'] . ' ' . $selectedCustomer['last_name']); ?></h4>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($selectedCustomer['email']); ?></p>
                        <p><strong>University:</strong> <?php echo htmlspecialchars($selectedCustomer['university']); ?></p>
                        <p><strong>Address:</strong> <?php echo htmlspecialchars($selectedCustomer['address'] . ', ' . $selectedCustomer['city'] . ', ' . $selectedCustomer['state'] . ', ' . $selectedCustomer['country'] . ', ' . $selectedCustomer['postal']); ?></p>
                        <p><strong>Phone:</strong> <?php echo htmlspecialchars($selectedCustomer['phone']); ?></p>
                        <?php else: ?>
                        <p>Select a customer to view details.</p>
                        <?php endif; ?>                                                                                                                                                                           
                    </div>    
                  </div>  <!-- / mdl-cell + mdl-card -->   

                  <!-- mdl-cell + mdl-card: Order Details -->
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Order Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">       
                               
                        <table class="mdl-data-table  mdl-shadow--2dp">
                          <thead>
                            <tr>
                              <th class="mdl-data-table__cell--non-numeric">Cover</th>
                              <th class="mdl-data-table__cell--non-numeric">ISBN</th>
                              <th class="mdl-data-table__cell--non-numeric">Title</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if ($selectedCustomer !== null): ?>
                              <?php if (count($orders) > 0): ?>
                                <?php foreach ($orders as $order): ?>
                                <tr>
                                  <td class="mdl-data-table__cell--non-numeric">
                                    <img src="images/tinysquare/<?php echo htmlspecialchars($order['isbn']); ?>.jpg" alt="<?php echo htmlspecialchars($order['title']); ?>">
                                  </td>
                                  <td class="mdl-data-table__cell--non-numeric"><?php echo htmlspecialchars($order['isbn']); ?></td>
                                  <td class="mdl-data-table__cell--non-numeric"><?php echo htmlspecialchars($order['title']); ?></td>
                                </tr>
                                <?php endforeach; ?>
                              <?php else: ?>
                                <tr>
                                  <td colspan="3" class="mdl-data-table__cell--non-numeric">No orders for this customer.</td>
                                </tr>
                              <?php endif; ?>
                            <?php endif; ?>
                          </tbody>
                        </table>

                    </div>    
                  </div>  <!-- / mdl-cell + mdl-card -->             

               </div>   
           
           
            </div>  <!-- / mdl-grid -->    

        </section>
        <footer style="text-align: center; padding: 20px; background-color: #f5f5f5; margin-top: 20px;">
            <p>CISC3003 Web Programming: DC227153 LEONG CHI LONG 2026</p>
        </footer>
    </main>    
</div>    <!-- / mdl-layout --> 

<script>
$(function() {
    $('.inlinesparkline').sparkline('html', {type: 'bar', barColor: '#4527A0', height: '20px'});
});
</script>
          
</body>
</html>
