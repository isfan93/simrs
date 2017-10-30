CREATE VIEW v_tindakan AS SELECT mt.treat_id,mt.treat_name,mt.koef_id,
mkf.koef_treathment,mp.pl_id,mp.pl_name,mt.treat_master_fee,mt.treat_item_price
FROM mst_treathment mt 
			JOIN mst_poly mp ON (mp.pl_id=mt.poli)
			JOIN mst_koefisien_fee mkf ON(mkf.koef_id=mt.koef_id)
			ORDER BY mt.treat_id desc