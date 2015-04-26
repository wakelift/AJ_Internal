<script type="text/javascript">
var SkillsDialog = {
	local_ed : 'ed',
	init : function(ed) {
		SkillsDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertSkill(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 		 
		var content = jQuery('textarea#section-content').val();
		
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();

		var title = jQuery('input#skill-title').val();
		var percent = jQuery('input#skill-percent').val();

		// setup the output of our shortcode
		output = '[skill';
		output += ' title=\"'+title+'"';
		output += ' percent=\"'+percent+'"';
					
		output += ']';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(SkillsDialog.init, SkillsDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
	
	
		<div class="form-section clearfix">
            <label for="skill-title">Skill Title:</label>
            <input type="text" name="skill-title" value="" id="skill-title" />
        </div>

		<div class="form-section clearfix">
            <label for="skill-percent">Skill Percent<br/><small>Enter a number 1-100 (no % is needed).</small></label>
            <input type="text" name="skill-percent" value="" id="skill-percent" />
        </div>
		
    <a href="javascript:SkillsDialog.insert(SkillsDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>