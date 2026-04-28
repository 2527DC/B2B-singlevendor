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