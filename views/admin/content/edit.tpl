{if $sSuperAdmin == true}
	{include file="inc_header.tpl" page_title="Content Pages : Edit Page" menu="content" page_style="halfContent"}
{else}
	{include file="inc_header.tpl" page_title="Content Pages : Edit Page" menu="content" page_style="fullContent"}
{/if}
{assign var=subMenu value="Content Pages"}

<form method="post" action="/admin/content/edit/s/">
	<input type="hidden" name="id" value="{$aPage.id}">
	<section id="content" class="content">
		<header>
			<h2>Content Pages &raquo; Edit Page</h2>
		</header>

		<section class="inner-content">
			{if $aPage.module != 1}
				<label>*Page Title:</label><br />
				<input type="text" name="title" maxlength="100" value="{$aPage.title|clean_html}"><br />
			{else}
				<h3>{$aPage.title|clean_html}</h3>
				<input type="hidden" name="title" value="{$aPage.title|clean_html}">
			{/if}
	
			<label>Content:</label><br />
			{html_editor content=$aPage.content name="content"}
	
			<input type="submit" value="Save Changes"> <a class="cancel" href="/admin/content/" title="Cancel">Cancel</a>
		</section>
	</section>
		
	{if $sSuperAdmin == true}
		<section id="sidebar" class="sidebar">
			<header>
				<h2>Page Options</h2>
			</header>

			<section>
				<label>Tag:</label><br />
				<input type="text" name="tag" maxlength="100" value="{$aPage.tag|clean_html}"><br>
		
				<label>Permanent:</label>
				<input type="checkbox" name="perminate" value="1"{if $aPage.perminate == 1} checked="checked"{/if}><br />
		
				<label>Module:</label>
				<input type="checkbox" name="module" value="1"{if $aPage.module == 1} checked="checked"{/if}><br />
		
				<label>Template:</label>
				<select name="template">
					<option value="">Default</option>
					{foreach from=$aTemplates item=template}
						<option value="{$template}"{if $aPage.template == $template} selected="selected"{/if}>{$template}</option>
					{/foreach}
				</select><br />
			</section>
		</section>
	{/if}
</form>
<script type="text/javascript">
{literal}
$(function(){
	$("form").validateForm([
		"required,title,Page Title is required"
	]);
});
{/literal}
</script>
{include file="inc_footer.tpl"}