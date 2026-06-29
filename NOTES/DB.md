# DB


### migrations
* `id` | int unsigned (auto increment)
* `migration` | varchar(255)
* `batch` | int
### password_reset_tokens
* `email` | varchar(255)
* `token` | varchar(255)
* `created_at` | timestamp
* ### personal_access_tokens

* `id` | bigint unsigned (auto increment)
* `tokenable_type` | varchar(255)
* `tokenable_id` | bigint unsigned
* `name` | text
* `token` | varchar(64) UNIQUE
* `abilities` | text NULL
* `last_used_at` | timestamp NULL
* `expires_at` | timestamp NULL
* `created_at` | timestamp
* `updated_at` | timestamp

### sessions
* `id` | varchar(255)
* `user_id` | bigint unsigned
* `ip_address` | varchar(45)
* `user_agent` | text
* `payload` | longtext
* `last_activity` | int
### users
* `id` | bigint unsigned (auto increment)
* `name` | varchar(255)
* `email` | varchar(255)
* `email_verified_at` | timestamp
* `password` | varchar(255)
* `remember_token` | varchar(100)
* `created_at` | timestamp
* `updated_at` | timestamp
---

### users 

* `role` | ENUM('admin', 'user')columns to add
* `first_name` | varchar(255)
* `last_name` | varchar(255)
* `phone` | varchar(255) NULL
### tickets
* `id` | bigint unsigned (auto increment)
* `user_id` | bigint unsigned — FK → users.id (creator)
* `assigned_to` | bigint unsigned NULL — FK → users.id (assignee)
* `title` | varchar(255)
* `description` | TEXT
* `status` | ENUM('in_afwachting', 'in_behandeling', 'afgehandeld') DEFAULT 'in_afwachting'
* `created_at` | timestamp
* `updated_at` | timestamp
### categories
* `id` | bigint unsigned (auto increment)
* `name` | varchar(255) UNIQUE
* `created_at` | timestamp
* `updated_at` | timestamp
### category_ticket
* `ticket_id` | bigint unsigned — FK → tickets.id
* `category_id` | bigint unsigned — FK → categories.id
* UNIQUE (`ticket_id`, `category_id`)
### ticket_comments
* `id` | bigint unsigned (auto increment)
* `ticket_id` | bigint unsigned — FK → tickets.id
* `user_id` | bigint unsigned — FK → users.id
* `message` | TEXT
* `edited_at` | timestamp NULL
* `created_at` | timestamp
* `updated_at` | timestamp
### notes
* `id` | bigint unsigned (auto increment)
* `ticket_id` | bigint unsigned — FK → tickets.id
* `user_id` | bigint unsigned — FK → users.id
* `note` | TEXT
* `created_at` | timestamp
* `updated_at` | timestamp


---

## Relationships
* users 1─N tickets (creator)
* users 1─N tickets (assignee)
* users 1─N ticket_comments
* users 1─N notes
* tickets 1─N ticket_comments
* tickets 1─N notes
* tickets N─N categories (via category_ticket)