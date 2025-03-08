<?php
require_once('tcpdf/tcpdf.php'); // Ensure TCPDF is included
include "Conn.php";
session_start();

if (!isset($_GET['order_id'])) {
    die("Order ID is missing.");
}

$order_id = $_GET['order_id'];

// Fetch Order Details
$order_query = "SELECT * FROM orders WHERE Order_Id = '$order_id'";
$result_order = mysqli_query($conn, $order_query);
$order = mysqli_fetch_assoc($result_order);

if (!$order) {
    die("Invalid Order ID.");
}

// Fetch Ordered Items
$order_items_query = "SELECT product.Product_Name, product.Price 
                      FROM order_items 
                      INNER JOIN product ON order_items.Product_Id = product.Product_Id 
                      WHERE order_items.Order_Id = '$order_id'";

$result_items = mysqli_query($conn, $order_items_query);
$order_items = mysqli_fetch_all($result_items, MYSQLI_ASSOC);

// GST Calculation
$gst_rate = 0.18;
$gst_amount = $order['Total_Amount'] * $gst_rate;
$grand_total = $order['Total_Amount'] + $gst_amount;

// Create PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('StyleAdda');
$pdf->SetTitle('Invoice - StyleAdda');
$pdf->SetHeaderData('', 0, 'StyleAdda Invoice', "Order ID: #$order_id");
$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('dejavusans', '', 12);
$pdf->AddPage();

// Logo & Title
$pdf->Image('assets/logo.png', 15, 10, 50); // Ensure your logo is placed in "assets/logo.png"
$pdf->Ln(20); // Line break

// HTML Invoice Content
$html = '<h2 style="text-align:center;">Invoice</h2>
         <p><strong>Order ID:</strong> ' . $order['Order_Id'] . '</p>
         <p><strong>Shipping Address:</strong> ' . htmlspecialchars($order['Address']) . '</p>
         <p><strong>Payment Method:</strong> ' . htmlspecialchars($order['Payment_Method']) . '</p>
         <br>
         <table border="1" cellspacing="0" cellpadding="5">
            <tr style="background-color:#007BFF; color:white;">
                <th>Product Name</th>
                <th>Price (₹)</th>
            </tr>';

foreach ($order_items as $item) {
    $html .= '<tr>
                <td>' . htmlspecialchars($item['Product_Name']) . '</td>
                <td>₹' . htmlspecialchars($item['Price']) . '</td>
              </tr>';
}

$html .= '<tr>
            <td style="text-align:right; font-weight:bold;">Subtotal:</td>
            <td>₹' . number_format($order['Total_Amount'], 2) . '</td>
          </tr>
          <tr>
            <td style="text-align:right; font-weight:bold;">GST (18%):</td>
            <td>₹' . number_format($gst_amount, 2) . '</td>
          </tr>
          <tr>
            <td style="text-align:right; font-weight:bold;">Grand Total:</td>
            <td>₹' . number_format($grand_total, 2) . '</td>
          </tr>
         </table>';

// Add Content to PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output PDF for Download
$pdf->Output('invoice_' . $order_id . '.pdf', 'D');
?>
