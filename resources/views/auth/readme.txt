==========================
AUTH MODULE
==========================

1. login.blade.php
--------------------------
Who:
- Guest users only

Purpose:
Login to the system.

Contains:
- Email
- Password
- Login button

Actions:
- Login

Result:
- Active user with changed password → Dashboard
- User with temporary password → Force Change Password page
- Login is limited to 3 attempts per minute


2. force-change-password.blade.php
--------------------------
Who:
- Logged-in users using a temporary password

Purpose:
Force the user to create a new private password before accessing the system.

Contains:
- New password
- Confirm password

Actions:
- Save new password

Result:
- Temporary password is replaced
- User can access Dashboard and allowed modules


3. profile.blade.php
--------------------------
Who:
- Every logged-in active user

Purpose:
View personal account details and change own password.

Actions:
- Change own password
- Logout
