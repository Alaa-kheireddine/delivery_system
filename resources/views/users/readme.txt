=====================================================
USERS MODULE
=====================================================

1. users/index.blade.php
--------------------------
Who:
- Admin
- Manager (only users from own branch, excluding managers/admins)

Purpose:
Central page for managing system users.

Contains:
- User statistics
- Search by name/email
- Role filter
- Status filter
- Password status filter
- Branch filter for Admin
- Users table

Actions:

Admin
- Create users
- View users
- Edit users
- Activate / deactivate users
- Reset users’ passwords

Manager
- View permitted users in own branch
- Create users if permission is assigned
- Edit permitted branch users
- Activate / deactivate permitted users

Important:
- Creating a user with role Client automatically creates the Client record.
- A temporary password is generated.
- User must change the temporary password on first login.


2. users/show.blade.php
--------------------------
Who:
- Admin
- Manager for allowed users in own branch

Purpose:
Complete details page for one user.

Contains:
- Personal information
- Role
- Branch
- Salary
- Account status
- Password/security status
- Account creation and update dates

Actions:
- Edit user
- Reset password, when permitted


3. users/edit.blade.php
--------------------------
Who:
- Admin
- Manager, according to permissions and branch access

Purpose:
Update a user account.

Contains:
- Name
- Email
- Phone
- Salary
- Role
- Branch

Actions:
- Save changes
- Reset password

Restriction:
- An employee cannot be converted into a Client from this page.
