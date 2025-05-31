CREATE TABLE IF NOT EXISTS "migrations"(
  "id" integer primary key autoincrement not null,
  "migration" varchar not null,
  "batch" integer not null
);
CREATE TABLE IF NOT EXISTS "users"(
  "id" integer primary key autoincrement not null,
  "name" varchar not null,
  "email" varchar not null,
  "email_verified_at" datetime,
  "password" varchar not null,
  "remember_token" varchar,
  "created_at" datetime,
  "updated_at" datetime,
  "role" varchar not null default 'user',
  "phone" varchar,
  "address" varchar
);
CREATE UNIQUE INDEX "users_email_unique" on "users"("email");
CREATE TABLE IF NOT EXISTS "password_reset_tokens"(
  "email" varchar not null,
  "token" varchar not null,
  "created_at" datetime,
  primary key("email")
);
CREATE TABLE IF NOT EXISTS "sessions"(
  "id" varchar not null,
  "user_id" integer,
  "ip_address" varchar,
  "user_agent" text,
  "payload" text not null,
  "last_activity" integer not null,
  primary key("id")
);
CREATE INDEX "sessions_user_id_index" on "sessions"("user_id");
CREATE INDEX "sessions_last_activity_index" on "sessions"("last_activity");
CREATE TABLE IF NOT EXISTS "cache"(
  "key" varchar not null,
  "value" text not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE TABLE IF NOT EXISTS "cache_locks"(
  "key" varchar not null,
  "owner" varchar not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE TABLE IF NOT EXISTS "jobs"(
  "id" integer primary key autoincrement not null,
  "queue" varchar not null,
  "payload" text not null,
  "attempts" integer not null,
  "reserved_at" integer,
  "available_at" integer not null,
  "created_at" integer not null
);
CREATE INDEX "jobs_queue_index" on "jobs"("queue");
CREATE TABLE IF NOT EXISTS "job_batches"(
  "id" varchar not null,
  "name" varchar not null,
  "total_jobs" integer not null,
  "pending_jobs" integer not null,
  "failed_jobs" integer not null,
  "failed_job_ids" text not null,
  "options" text,
  "cancelled_at" integer,
  "created_at" integer not null,
  "finished_at" integer,
  primary key("id")
);
CREATE TABLE IF NOT EXISTS "failed_jobs"(
  "id" integer primary key autoincrement not null,
  "uuid" varchar not null,
  "connection" text not null,
  "queue" text not null,
  "payload" text not null,
  "exception" text not null,
  "failed_at" datetime not null default CURRENT_TIMESTAMP
);
CREATE UNIQUE INDEX "failed_jobs_uuid_unique" on "failed_jobs"("uuid");
CREATE TABLE IF NOT EXISTS "scooters"(
  "id" integer primary key autoincrement not null,
  "name" varchar not null,
  "brand" varchar not null,
  "model" varchar not null,
  "description" text not null,
  "price" numeric not null,
  "year" integer not null,
  "color" varchar not null,
  "stock" integer not null default '0',
  "image" varchar,
  "featured" tinyint(1) not null default '0',
  "created_at" datetime,
  "updated_at" datetime
);
CREATE TABLE IF NOT EXISTS "parts"(
  "id" integer primary key autoincrement not null,
  "name" varchar not null,
  "category" varchar not null,
  "description" text not null,
  "price" numeric not null,
  "sku" varchar not null,
  "stock" integer not null default '0',
  "image" varchar,
  "compatible_with_all" tinyint(1) not null default '0',
  "created_at" datetime,
  "updated_at" datetime
);
CREATE UNIQUE INDEX "parts_sku_unique" on "parts"("sku");
CREATE TABLE IF NOT EXISTS "services"(
  "id" integer primary key autoincrement not null,
  "name" varchar not null,
  "description" text not null,
  "price" numeric,
  "duration" varchar,
  "image" varchar,
  "featured" tinyint(1) not null default '0',
  "created_at" datetime,
  "updated_at" datetime
);
CREATE TABLE IF NOT EXISTS "orders"(
  "id" integer primary key autoincrement not null,
  "user_id" integer not null,
  "total_amount" numeric not null,
  "status" varchar check("status" in('pending', 'processing', 'completed', 'cancelled')) not null default 'pending',
  "payment_method" varchar,
  "payment_status" varchar not null default 'pending',
  "shipping_address" varchar,
  "billing_address" varchar,
  "tracking_number" varchar,
  "notes" text,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("user_id") references "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "order_items"(
  "id" integer primary key autoincrement not null,
  "order_id" integer not null,
  "orderable_type" varchar not null,
  "orderable_id" integer not null,
  "quantity" integer not null,
  "price" numeric not null,
  "total" numeric not null,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("order_id") references "orders"("id") on delete cascade
);
CREATE INDEX "order_items_orderable_type_orderable_id_index" on "order_items"(
  "orderable_type",
  "orderable_id"
);
CREATE TABLE IF NOT EXISTS "quote_requests"(
  "id" integer primary key autoincrement not null,
  "user_id" integer,
  "service_id" integer,
  "name" varchar not null,
  "email" varchar not null,
  "phone" varchar,
  "message" text not null,
  "scooter_model" varchar,
  "scooter_year" integer,
  "status" varchar check("status" in('pending', 'processing', 'completed', 'cancelled')) not null default 'pending',
  "quoted_price" numeric,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("user_id") references "users"("id") on delete set null,
  foreign key("service_id") references "services"("id") on delete set null
);
CREATE TABLE IF NOT EXISTS "part_scooter"(
  "id" integer primary key autoincrement not null,
  "part_id" integer not null,
  "scooter_id" integer not null,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("part_id") references "parts"("id") on delete cascade,
  foreign key("scooter_id") references "scooters"("id") on delete cascade
);
CREATE UNIQUE INDEX "part_scooter_part_id_scooter_id_unique" on "part_scooter"(
  "part_id",
  "scooter_id"
);

INSERT INTO migrations VALUES(1,'0001_01_01_000000_create_users_table',1);
INSERT INTO migrations VALUES(2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO migrations VALUES(3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO migrations VALUES(4,'2025_05_23_101541_create_scooters_table',1);
INSERT INTO migrations VALUES(5,'2025_05_23_101546_create_parts_table',1);
INSERT INTO migrations VALUES(6,'2025_05_23_101551_create_services_table',1);
INSERT INTO migrations VALUES(7,'2025_05_23_101557_create_orders_table',1);
INSERT INTO migrations VALUES(8,'2025_05_23_101602_create_order_items_table',1);
INSERT INTO migrations VALUES(9,'2025_05_23_101608_create_quote_requests_table',1);
INSERT INTO migrations VALUES(10,'2025_05_23_101619_add_role_to_users_table',1);
INSERT INTO migrations VALUES(11,'2025_05_23_102217_create_part_scooter_table',1);
