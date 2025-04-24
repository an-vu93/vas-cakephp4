#!/bin/bash

# Set MySQL credentials
DB_USER="root"
DB_NAME="vasdatabase_2"
DB_HOST="localhost"  

mysql "$DB_HOST" -u "$DB_USER" -p "$DB_NAME" << EOF
SET SESSION sql_mode = REPLACE(@@sql_mode, 'STRICT_TRANS_TABLES', '');
SET SESSION sql_mode = REPLACE(@@sql_mode, 'NO_ZERO_DATE', '');

INSERT INTO customers (id, name, postal_code, address, own_flg, support_remarks, support_memo, outgoing_flg, remarks, relationship, cs_staff_id, replace_proposal_flg, be_carefull_remarks, sfa_customer_id)
SELECT 
    tmp.id, 
    tmp.name AS name, 
    tmp.post AS postal_code, 
    tmp.address AS address, 
    tmp.own_flg AS own_flg, 
    tmp.support_remarks AS support_remarks, 
    tmp.support_memo AS support_memo, 
    tmp.outgoing_flg AS outgoing_flg, 
    tmp.remarks AS remarks, 
    tmp.relationship AS relationship, 
    tmp.cs_staff_id AS cs_staff_id, 
    tmp.replace_proposal AS replace_proposal_flg, 
    tmp.be_careful_remarks AS be_carefull_remarks, 
    tmp.sfa_c_id AS sfa_customer_id
FROM tmp_customers tmp
WHERE own_flg <> 1
ON DUPLICATE KEY UPDATE 
    name = VALUES(name),
    postal_code = VALUES(postal_code),
    address = VALUES(address),
    own_flg = VALUES(own_flg),
    support_remarks = VALUES(support_remarks),
    support_memo = VALUES(support_memo),
    outgoing_flg = VALUES(outgoing_flg),
    remarks = VALUES(remarks),
    relationship = VALUES(relationship),
    cs_staff_id = VALUES(cs_staff_id),
    replace_proposal_flg = VALUES(replace_proposal_flg),
    be_carefull_remarks = VALUES(be_carefull_remarks),
    sfa_customer_id = VALUES(sfa_customer_id)


INSERT INTO customer_profiles (customer_id, prefecture_id) 
SELECT c.id, c.prefecture_id
FROM customers c 
WHERE NOT EXISTS
    (
        SELECT 1 
        FROM customer_profiles cp 
        WHERE cp.customer_id = c.id 
    );

TRUNCATE customer_metrics;

INSERT INTO customer_metrics (customer_id, created, modified) 
SELECT c.id, NOW(), NOW()
FROM customers c 
WHERE NOT EXISTS
    (
        SELECT 1 
        FROM customer_metrics cm
        WHERE cm.customer_id = c.id 
    );

TRUNCATE customer_products;
SET SESSION sql_mode = REPLACE(@@sql_mode, 'STRICT_TRANS_TABLES', '');
SET SESSION sql_mode = REPLACE(@@sql_mode, 'NO_ZERO_DATE', '');
INSERT INTO customer_products (id, customer_id, site_url, product_type_id, salesperson_id, cancel_flg, replace_flg, shift_goods_flg, order_date, created)
SELECT id, c_id, site_url, goodskind, business, cancel_flg, replace_flg, shift_goods_flg, order_date, created
FROM tmp_goods;

TRUNCATE customer_products_options;
INSERT INTO customer_products_options (id, customer_product_id, option_id)
SELECT id, good_id, serviceoption_id
FROM tmp_services;

UPDATE customer_products 
SET order_date = NULL 
WHERE order_date < '1000-01-01';

TRUNCATE customer_orders;

INSERT INTO customer_orders (
  id,
  customer_id,
  order_date,
  it_subsidy_object,
  free_flg,
  monthly_flg,
  shinki_flg,
  verup_flg,
  hoshu_flg,
  monthly_ssp_flg,
  order_price,
  created,
  modified
)
SELECT 
  id,
  customers_id,
  orderdate,
  it_subsidy_object,
  free_flag,
  monthly_flg,
  shinki,
  verup + replace_flg,
  hoshu,
  monthly_ssp_flg,
  order_price,
  created,
  modified
FROM tmp_projects;

TRUNCATE customer_contacts;

INSERT INTO customer_contacts (id, parent_id, customer_id, call_type, rating, reception_subject, reception_date)
SELECT id, parent_id, c_id, call_type, rating, reception_subject, reception_date_write
FROM tmp_contacts;

// Update metric values

UPDATE customer_metrics cm
INNER JOIN (
    SELECT 
        c.id as customer_id,
        MIN(co.order_date) as first_order,
        MAX(co.order_date) as last_order
    FROM customers c
    LEFT JOIN customer_products co ON co.customer_id = c.id
    WHERE co.product_type_id IN (
        SELECT product_type_id 
        FROM oricoh_series
    )
    AND co.cancel_flg <> 1
    GROUP BY c.id
) derived_table
ON cm.customer_id = derived_table.customer_id
SET 
    cm.first_order_date = derived_table.first_order,
    cm.last_order_date = derived_table.last_order;


UPDATE customer_metrics cm
INNER JOIN (
    SELECT 
        c.id as customer_id,
        COUNT(co.id) oricoh_license_count
    FROM customers c
    LEFT JOIN customer_products co ON co.customer_id = c.id
    WHERE co.product_type_id IN (
        SELECT product_type_id 
        FROM oricoh_series
    )
    AND co.cancel_flg <> 1
    GROUP BY c.id
) derived_table
ON cm.customer_id = derived_table.customer_id
SET 
    cm.oricoh_license_count = derived_table.oricoh_license_count

UPDATE customer_metrics cm
INNER JOIN (
    SELECT 
        c.id as customer_id,
        COUNT(co.id) other_license_count
    FROM customers c
    LEFT JOIN customer_products co ON co.customer_id = c.id
    WHERE co.product_type_id NOT IN (
        SELECT product_type_id 
        FROM oricoh_series
    )
    AND co.cancel_flg <> 1
    GROUP BY c.id
) derived_table
ON cm.customer_id = derived_table.customer_id
SET 
    cm.other_license_count = derived_table.other_license_count


UPDATE customer_metrics cm
INNER JOIN (
    SELECT 
        c.id as customer_id,
        COUNT(co.id) other_license_count
    FROM customers c
    LEFT JOIN customer_products co ON co.customer_id = c.id
    WHERE co.product_type_id NOT IN (
        SELECT product_type_id 
        FROM oricoh_series
    )
    AND co.cancel_flg <> 1
    GROUP BY c.id
) derived_table
ON cm.customer_id = derived_table.customer_id
SET 
    cm.other_license_count = derived_table.other_license_count


UPDATE customer_metrics cm
INNER JOIN (
    SELECT 
        cc.customer_id as customer_id,
        COUNT(cc.id) in_contact_count
    FROM customer_contacts cc
    WHERE cc.call_type = 1
    GROUP BY customer_id
) derived_table
ON cm.customer_id = derived_table.customer_id
SET 
    cm.in_contact_count = derived_table.in_contact_count


UPDATE customer_metrics cm
INNER JOIN (
    SELECT 
        cc.customer_id as customer_id,
        COUNT(cc.id) out_contact_count
    FROM customer_contacts cc
    WHERE cc.call_type = 2
    GROUP BY customer_id
) derived_table
ON cm.customer_id = derived_table.customer_id
SET 
    cm.out_contact_count = derived_table.out_contact_count


UPDATE customer_metrics cm
INNER JOIN (
    SELECT customer_id, COUNT(shift_goods_flg) AS verup_count
    FROM customer_products
    WHERE shift_goods_flg = 1
    GROUP BY customer_id
) co ON cm.customer_id = co.customer_id
SET cm.verup_count = co.verup_count;


UPDATE customer_metrics cm
INNER JOIN (
    SELECT customer_id, COUNT(id) AS order_count
    FROM customer_orders
    WHERE shinki_flg = 1 OR verup_flg = 1  
    GROUP BY customer_id
) jtb ON cm.customer_id = jtb.customer_id
SET cm.order_count = jtb.order_count;


UPDATE customer_metrics cm 
INNER JOIN
(
    SELECT  cp.customer_id, COUNT(DISTINCT cp.id) option_included_order_count
	FROM customer_products cp
	INNER JOIN customer_products_options cpo ON cpo.customer_product_id = cp.id
	INNER JOIN options o ON cpo.option_id = o.id  
	GROUP BY cp.customer_id
) jtb ON jtb.customer_id = cm.customer_id
SET cm.option_included_order_count = jtb.option_included_order_count;


UPDATE customer_metrics cm
INNER JOIN (
SELECT cp.customer_id, SUM(d.week_login_cnt) week_login_count, SUM(d.week_edit_cnt) week_edit_count
FROM customers c
INNER JOIN customer_products cp ON cp.customer_id = c.id 
INNER JOIN dashboard_datas d ON d.goods_id = cp.id  
GROUP BY c.id
) jtb ON jtb.customer_id = cm.customer_id
SET cm.week_login_count = jtb.week_login_count, cm.week_edit_count = jtb.week_edit_count;

UPDATE customer_metrics cm
INNER JOIN (
SELECT co.customer_id, SUM(order_price) all_order_amount
FROM customers c
INNER JOIN customer_orders co ON co.customer_id = c.id
GROUP BY c.id
) jtb ON jtb.customer_id = cm.customer_id
SET cm.all_order_amount = jtb.all_order_amount

UPDATE customer_metrics cm
INNER JOIN customers c ON c.id = cm.customer_id
SET cm.relationship_strength = c.relationship;

DROP TABLE tmp_customers;
DROP TABLE tmp_goods;
DROP TABLE tmp_services;
DROP TABLE tmp_projects;
DROP TABLE tmp_contacts;
EOF