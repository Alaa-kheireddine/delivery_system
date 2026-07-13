=====================================================
ROLES & PERMISSIONS MODULE
=====================================================

1. roles/index.blade.php
--------------------------
Who:
- Users with Roles permissions
- Normally Admin

Purpose:
Manage system roles and their access permissions.

Contains:
- Roles list
- Number of users per role
- Number of permissions per role
- Permissions grouped by module

Actions:
- Create role
- Edit role name
- Assign/remove permissions
- Delete role

Restrictions:
- Default admin role is not shown in the list and cannot be edited.
- A user cannot edit or delete their own role.
- A role cannot be deleted if users are assigned to it.

Current default roles:
- Admin
- Manager
- Accountant
- Warehouse
- Collector
- Delivery Agent
- Client
