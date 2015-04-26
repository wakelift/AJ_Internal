<script type="text/javascript">
var ImageBoxDialog = {
	local_ed : 'ed',
	init : function(ed) {
		ImageBoxDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertImageBox(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var url = jQuery('input#imagebox-url').val();
		var link = jQuery('input#imagebox-link').val();
		var title = jQuery('input#imagebox-title').val();
		var subtitle = jQuery('input#imagebox-subtitle').val();
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output += '[hb_image_box ';
		if ( url ) output += ' image=\"'+url+'\"';
		if ( link ) output += ' link=\"'+link+'\"';
		if ( title ) output += ' title=\"'+title+'\"';
		if ( subtitle ) output += ' subtitle=\"'+subtitle+'\"';
		output += ']';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(ImageBoxDialog.init, ImageBoxDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">
		<div class="form-section clearfix">
            <label for="imagebox-title">Title</label>
            <input type="text" name="imagebox-title" value="" id="imagebox-title" />
        </div>

        <div class="form-section clearfix">
            <label for="imagebox-subtitle">Subitle</label>
            <input type="text" name="imagebox-subtitle" value="" id="imagebox-subtitle" />
        </div>

        <div class="form-section clearfix">
            <label for="imagebox-url">Image URL</label>
            <input type="text" name="imagebox-url" value="" id="imagebox-url" />
        </div>
		
		<div class="form-section clearfix">
            <label for="imagebox-link">Link</label>
            <input type="text" name="imagebox-link" value="" id="imagebox-link" />
        </div>

    <a href="javascript:ImageBoxDialog.insert(ImageBoxDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
    
</form>