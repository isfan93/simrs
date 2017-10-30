CREATE VIEW v_obat AS SELECT iim.*,mti.mtype_name
FROM inv_item_master iim
LEFT JOIN mst_type_inv mti ON(mti.mtype_id=iim.im_unit)