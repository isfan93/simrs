ALTER TABLE trx_recipe_detail
ADD COLUMN recipe_price DOUBLE(10) AFTER recipe_number;

ALTER TABLE trx_recipe_detail
MODIFY COLUMN recipe_rule TEXT;

ALTER TABLE trx_racikan_detail 
ADD COLUMN racikan_medicine_price DOUBLE(10) AFTER racikan_medicine_qty;