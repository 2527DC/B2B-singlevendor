Added the Registration fields  to table and code and  update the  listing_paginate_data.blade.php or showing the strickoff for the amount 

added a column for shop image in  usertable
store_name
document
store_name
store_image

ALTER TABLE users
ADD store_name VARCHAR(191) NULL AFTER last_name,
ADD document VARCHAR(191) NULL AFTER document_type;
ADD store_image VARCHAR(191) 



The download button for the invoice in total_sales.blade.php triggers the shipping.invoice_generate route.

Here are the specific files responsible for handling the download and rendering the PDF layout:

1. The Controller responsible for the download: The route points to the invoiceGenerate method inside the ShippingOrderController.

File path: /var/www/DhatriProduction/Modules/Shipping/Http/Controllers/ShippingOrderController.php
2. The Blade template (UI) used for the PDF: Inside that controller method, it loads a specific blade view to construct the PDF content.

File path: /var/www/DhatriProduction/Modules/Shipping/Resources/views/order/invoice_pdf.blade.php (In the controller, it is referenced as shipping::order.invoice_pdf)
If you want to modify how the invoice PDF looks, you should edit the invoice_pdf.blade.php file!





Yes, this can absolutely be done within your existing system! Since you asked for the implementation plan without writing the code for you, here is exactly how you would architect and implement this step-by-step:

1. Database Modifications
First, you need to store the seller's short code and create a dedicated table to track sequential invoices to ensure no duplicates.

Add Seller Short Code: Add a new column like short_code (String, Unique) to the users table or seller_business_informations table. This allows the admin/seller to configure a unique prefix (e.g., "SDE" for Shree Dhatri Enterprises).
Create Invoices Table: Create an invoices migration/table with the following columns:
id
order_package_id (Foreign key to order_packages table)
seller_id (Foreign key to users table)
invoice_sequence (Integer - to keep track of 1, 2, 3...)
invoice_number (String - the final generated string)
timestamps
2. Modifying the Controller Logic
Next, you need to intercept the download process. You will modify the invoiceGenerate($id) method inside Modules/Shipping/Http/Controllers/ShippingOrderController.php.

When the user clicks the "Download Invoice" button, you should perform these steps:

Check for Existing Invoice: Check your new invoices table to see if an invoice already exists for this $id (order_package_id).
Return Existing: If it exists, grab the invoice_number from the database and generate the PDF using that number.
Generate New (If Missing): If it doesn't exist, you must generate a new one securely:
Start a Database Transaction: This is crucial. Use DB::transaction() and apply a lockForUpdate() query on the invoices table. This prevents two concurrent clicks from generating the same sequence number.
Get the Last Sequence: Query the invoices table for the highest invoice_sequence belonging to this specific seller_id.
Increment: Add 1 to the last sequence (if no previous invoices exist, it becomes 1).
Format the String: Grab the seller's short_code. Build the string: date('ymdhsi') . $seller->short_code . $new_sequence.
Save: Insert the new record into the invoices table.
3. Updating the PDF View
Finally, you update the UI to display this new invoice number.

In your ShippingOrderController, pass the generated/retrieved invoice_number into the $data array.
In Modules/Shipping/Resources/views/order/invoice_pdf.blade.php, replace all instances of {{ $order->package_code }} (next to the Inv. No. and barcode fields) with your new {{ $invoice_number }} variable.
Why this approach is safe:
Sequential per Seller: By filtering your max sequence query by seller_id, every vendor gets their own isolated sequence (e.g., Vendor A gets 1, 2, 3 and Vendor B gets 1, 2, 3).
Preventing Duplicates: Using database locks (lockForUpdate()) ensures that if a seller has multiple orders being processed at the exact same millisecond, they won't share the same sequence number.
Permanent Reference: Because it saves to a table upon the first download, if they download the invoice again 3 months later, it will fetch the exact same invoice number instead of generating a new date/timestamp.
16:30
