=====================================================
BRANCHES MODULE
=====================================================

1. branches/index.blade.php
--------------------------
Who:
- Admin
- Manager with branches.view permission

Purpose:
Manage company branches.

Contains:
- Branch statistics
- Search and filters
- Branches table
- Branch activity charts

Actions:

Admin
- View all branches
- Add branch
- Edit branch
- Activate / deactivate branch

Manager
- View own branch only
- Actions depend on assigned permissions


2. branches/show.blade.php
--------------------------
Who:
- Admin
- Manager of that branch

Purpose:
Show branch operational overview.

Contains:
- Branch information
- Status
- Total shipments
- Active shipments
- Delivered shipments
- Pending shipments
- Recent shipments

Actions:
- View branch details

Important:
- A branch cannot be deactivated when it has active shipments.
