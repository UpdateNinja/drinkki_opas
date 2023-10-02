1.01
Removed star_rating.php and change star rating based on function, so it is easier to call multiple places. Star rating function can be set as input or output.

1.02
Changed livesearch drinks to object oriented and created Drink.php class

1.03
Added functions for adding new drinks.

1.04
Allowed filetypes for upload file, file name using drink_image + date + random integer format. 

1.05
Added user register page with password hashing on client and serverside. Added sql table for users.

1.06
Added user register page username, email and password preg match check.

1.07
Check if username or email is already taken.

1.08
Login logic for users and $session test

1.09
Code cleaning, combining drink upload function.
Added php session logic for users and debugging problems.
Drink image preview function into add new drink site.

1.10
Adding more login and logout logic.
Changed login in popup form.

1.11
Added timestamps for adding new drink
Only logged in user can add drink

1.12
Fixing register and login page resultmessage bug.
Registerpage UI

1.13
Updating review send function.
Only loggedin user can send review. -> Add check on server side.

1.14
Added password confirmation javascript.
Prototyping new account registering verification. Activate.php

1.15
Activation code prototyping.
Login allowed only if user is activated using activate.php. -> Add mailer for activation.