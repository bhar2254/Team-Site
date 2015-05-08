<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	
</script>
<script type="text/javascript">
	CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },

	];
	

	// Remove some buttons, provided by the standard plugins, which we don't
	// need to have in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';
	CKEDITOR.replace('entry');
};

</script>
<script type="text/javascript">
function getTeamInfoFromUserInput(numIn)
{
    //We will assume that the team number in is not undefined.
    if(numIn != "")
    {
        var teamOut = null;
        $.get('services/form_teamlookup.php', {"teamnumber" : numIn}, function(data) {
                teamOut = numIn;
                $("#location").val(data.location);
                $("#team_name").val(data.teamname);
                $("#teamNameLbr").removeClass('teamnameTR');
                $("#teamNameField").removeClass('teamnameTR');
             }, "json");
             if(teamOut == null)
             {
                $("#location").val("");
                $("#team_name").val("");
                $("#teamNameLbr").addClass('teamnameTR');
                $("#teamNameField").addClass('teamnameTR');
             }
    }
    else
    {
        $("#location").val("");
        $("#team_name").val("");
                  $("#teamNameLbr").addClass('teamnameTR');
                $("#teamNameField").addClass('teamnameTR');
        //We should clear the location.
    }
}
</script>