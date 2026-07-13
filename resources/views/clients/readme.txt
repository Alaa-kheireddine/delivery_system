=====================================================
CLIENTS MODULE
=====================================================

1. clients/index.blade.php
--------------------------
Who:
- Admin
- Manager
- Accountant
- Client can logically access own Client record only

Purpose:
Manage delivery-company clients.

Contains:
- Client statistics
- Search
- Status filter
- Branch filter for Admin
- Clients table

Actions:
- View Client details
- Client creation is done from Users → Add New User → role Client
- Edit client details from Client Details page


2. clients/show.blade.php
--------------------------
Who:
- Admin
- Manager / Accountant for clients in their branch
- Client for own company profile

Purpose:
Full operational and financial profile of one client.

Contains:
- Client code
- Contact and address information
- Assigned branch
- Current balance
- Total client earnings
- Total paid amount
- Remaining amount
- Shipment statistics
- Recent payments
- Recent shipments
- Notes

Actions:
- Edit Client


3. clients/edit.blade.php
--------------------------
Who:
- Authorized management users

Purpose:
Update client/company information.

Contains:
- Company name
- Default delivery fee
- Contact person
- Email and phone
- City and address
- Branch
- Notes

Actions:
- Save changes