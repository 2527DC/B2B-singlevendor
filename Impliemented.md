Added the Registration fields and  update the  listing_paginate_data.blade.php or showing the strickoff for the amount 

added a column for shop image in  usertable
store_name
document
store_name
store_image

ALTER TABLE users
ADD store_name VARCHAR(191) NULL AFTER last_name,
ADD document VARCHAR(191) NULL AFTER document_type;
ADD store_image VARCHAR(191) 