<div class="contenttitle2">
 	<h3>Dynamic Table</h3>
</div><!--contenttitle--><br>
<table cellpadding="0" cellspacing="0" border="0" class="stdtable" id="dyntable">
    <colgroup>
        <col class="con0" />
        <col class="con1" />
        <col class="con0" />
        <col class="con1" />
        <col class="con0" />
    </colgroup>
    <thead>
        <tr>
            <th class="head0">Rendering engine</th>
            <th class="head1">Browser</th>
            <th class="head0">Platform(s)</th>
            <th class="head1">Engine version</th>
            <th class="head0">CSS grade</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th class="head0">Rendering engine</th>
            <th class="head1">Browser</th>
            <th class="head0">Platform(s)</th>
            <th class="head1">Engine version</th>
            <th class="head0">CSS grade</th>
        </tr>
    </tfoot>
    <tbody>
		<?for ($i=0;$i<100;$i++): ?>
			<tr class="gradeX">
	            <td>Trident</td>
	            <td>Internet Explorer 4.0</td>
	            <td>Win 95+</td>
	            <td class="center">4</td>
	            <td class="center">X</td>
	        </tr>
		<?endfor;?>
    </tbody>
</table>