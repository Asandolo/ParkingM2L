$(function () {
 
var civilite = new Array("mr.", "Mme."); // A color list used as an example for the List Field. May be generated via a database, in PHP...
 
$("#myTable td").on('click', function editField(event) { // Edit cells from #myTable on a simple click event. Click can be replaced by dblclick for a double clicks event.
	var originalContent = $(this).text(); // Cell original content
	 
	var relData = $.parseJSON($(event.target).attr('rel')); // Get Json from rel attribute
	 
	$(event.target).off("click", editField); // Disable click event when edition
	
	if (relData.type == "input") $(this).html('<input type="text" value=\"' + originalContent + '\" />'); // Generate input type field
	if (relData.type == "textarea") $(this).html('<textarea>' + originalContent + '</textarea>'); // Generate textarea type field
	if (relData.type == "checkbox") { // Generate checkbox type field
		if (originalContent == 1) var isChecked = ' checked="checked"'; else isChecked="";
		$(this).html('<input type="checkbox" value=\"' + originalContent + '\"' + isChecked + ' />');
	}
	if (relData.type == "select") { // Generate select type field
		var buildSelect = '<select>'; // Built the list with the color Array
		for (i=0; i<civilite.length; i++) {
			buildSelect += '<option value="' + civilite[i] + '"';
			if (civilite[i] == originalContent) buildSelect += ' selected';
			buildSelect += '>' + civilite[i] + '</option>';
		}
		buildSelect += '</select>';
		$(this).html(buildSelect);
	}
	
	$(this).children().first().focus(); // Put the cursor on the generated field
 
	$(this).children().first().keypress(function (e) { // keypress after modification
		if (e.which == 13 && !e.shiftKey) { // the keypress is Enter, and not Shift Enter (Shift Enter is kept to go on the line for the textarea field)
			var newContent = ""; // Init newContent
			if ( (relData.type == "input") || (relData.type == "textarea") || (relData.type == "select") ) newContent = $(this).val(); // Get new content value
			if (relData.type == "checkbox") {
				if ($("input[type='checkbox']").is(":checked")){
					newContent = 1;
				} else newContent = 0;
			}
			
			var data = {}; // Init data string
			data["id_membre"] = relData.id; // Include database row ID in the data
			//...add / change name field here
			if (relData.name == "nom_membre") data["nom_membre"] = newContent; // Include type field data
			if (relData.name == "prenom_membre") data["prenom_membre"] = newContent; // Include type field data
			if (relData.name == "mail_membre") data["mail_membre"] = newContent; // Include type field data
			if (relData.name == "adRue_membre") data["adRue_membre"] = newContent; // Include type field data
			if (relData.name == "adCP_membre") data["adCP_membre"] = newContent; // Include type field data
			if (relData.name == "adVille_membre") data["adVille_membre"] = newContent; // Include type field data
			if (relData.name == "civilite_membre") data["civilite_membre"] = newContent;


			$.ajax({ // jQuery Ajax
				type: 'POST',
				url: 'ajax.php', // URL called to the PHP file which will insert new value in the database
				data: data, // We send the data string
				timeout: 3000,
				success: function(data) {
					$('#result').html(data); },
				error: function() {
					$('#result').text('Problem'); }
			});
			
			$(this).parent().text(newContent); // New content appears in the modified cell
			$(event.target).on("click", editField); // Click event is allowed again
		}
	});
	 
	$(this).children().first().blur(function() { // If you click out of the cell, no modification is done
		$(this).parent().text(originalContent); // We put back the original content
		$(event.target).on("click", editField); // Click event is allowed again
	});
});
 
});