# EMAIL SERVER

* Password recovery

# DB

## User table

* PK `id`
* `role` ENUM('admin', 'user')
* `name` | varchar(255)
* `first_name` | varchar(255)
* `last_name` | varchar(255)
* `email` | varchar(255)
* `phone` | varchar(255)
* `email_verified_at` | timestamp
* `password` | varchar(255)
* `remember_token` | varchar(100)
* `created_at` | timestamp
* `updated_at` | timestamp

## Sessions table

* PK `id`
* `user_id` | int
* `ip_address` | varchar(45)
* `user_agent` | text
* `payload` | text
* `last_activity` | int

## Password Resets table

* `email` | varchar(255)
* `token` | varchar(255)
* `created_at` | timestamp

## Migrations table

* `id` | int
* `migration` | varchar(255)
* `batch` | int

## Ticket table

* FK to User
* FK to User if Admin

    * Separate table?
    * Many-to-many?
    * Admin must be able to be assigned to a ticket.
* `status`

    * In afwachting
    * In behandeling
    * Afgehandeld

## Category table

* PK `id`
* `name` | varchar(255)
* `created_at` | timestamp
* `updated_at` | timestamp

## Assigned To table

* ...

## Ticket Comments table

> Also email notifications. Editable by admin and ticket owner only.

* `id`
* `ticket_id`
* `user_id`
* `message` | TEXT
* `edited_at` | NULL / timestamp
* `created_at` | timestamp
* `updated_at` | timestamp

## Notes table

> Admin only. Editable and deletable.

* `id`
* `ticket_id`
* `user_id`
* `note` | TEXT
* `created_at` | timestamp
* `updated_at` | timestamp
