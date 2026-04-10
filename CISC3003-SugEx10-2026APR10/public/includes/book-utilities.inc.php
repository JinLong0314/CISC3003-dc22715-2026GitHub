<?php

function readCustomers($filename) {
    $customers = array();
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines !== false) {
        foreach ($lines as $line) {
            $fields = explode(";", $line);
            $customer = array(
                'id' => trim($fields[0]),
                'first_name' => trim($fields[1]),
                'last_name' => trim($fields[2]),
                'email' => trim($fields[3]),
                'university' => trim($fields[4]),
                'address' => trim($fields[5]),
                'city' => trim($fields[6]),
                'state' => trim($fields[7]),
                'country' => trim($fields[8]),
                'postal' => trim($fields[9]),
                'phone' => trim($fields[10]),
                'sales' => trim($fields[11])
            );
            $customers[] = $customer;
        }
    }
    return $customers;
}

function readOrders($customer, $filename) {
    $orders = array();
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines !== false) {
        foreach ($lines as $line) {
            $fields = explode(",", $line);
            $order_customer_id = trim($fields[1]);
            if ($order_customer_id == $customer) {
                $order = array(
                    'order_id' => trim($fields[0]),
                    'customer_id' => trim($fields[1]),
                    'isbn' => trim($fields[2]),
                    'title' => trim($fields[3]),
                    'category' => trim($fields[4])
                );
                $orders[] = $order;
            }
        }
    }
    return $orders;
}

?>