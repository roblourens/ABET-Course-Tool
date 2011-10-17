<link type="text/css" href="http://datatables.net/release-datatables/media/css/demo_table.css" />
		<script type="text/javascript" language="javascript" src="http://datatables.net/release-datatables/media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="http://datatables.net/release-datatables/media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			/* Global var for counter */
			var giCount = 1;
			var giMax = 9;
			
			$(document).ready(function() {
				$('#example').dataTable();
			} );
			
			function fnClickAddRow() {
				if(giCount > giMax){
					alert("Can not add more then 10");
					return;	
				}
				$('#example').dataTable().fnAddData( [
					giCount+".1",
					giCount+".2",
					giCount+".3",
					giCount+".4" ] );
				
				giCount++;
			}
		</script>



			
			<p><a href="javascript:void(0);" onclick="fnClickAddRow();">Click to add a new row</a></p>
			
            
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th>Column 1</th>
			<th>Column 2</th>
			<th>Column 3</th>
			<th>Column 4</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>allan</td>
			<td>allan</td>
			<td>allan</td>
			<td>allan</td>
		</tr>
	</tbody>
</table>