{$menu = "galleries"}
{include file="inc_header.tpl" page_title="Photo Gallery"}

	{if $aCategories|@count gt 1}
	<form name="category" method="get" action="/galleries/" class="sortCat">
		Category:
		<select name="category">
			<option value="">- All Categories -</option>
			{foreach from=$aCategories item=aCategory}
				<option value="{$aCategory.id}"{if $aCategory.id == $smarty.get.category} selected="selected"{/if}>{$aCategory.name}</option>
			{/foreach}
		</select>
		<script type="text/javascript">
		$(function(){ldelim}
			$('select[name=category]').change(function(){ldelim}
				$('form[name=category]').submit();
			{rdelim});
		{rdelim});
		</script>
	</form>
	{/if}

	<h2>Photo Gallery</h2>
	<div class="clear">&nbsp;</div>

	{foreach from=$aGalleries item=aGallery}
		<article>
			{if $aGallery.defaultPhoto > 0}
				<figure>
					<a href="{$aGallery.url}" title="{$aGallery.name}"><img src="/image/crop/?file={$sImageFolder}{$aGallery.id}/{$aGallery.defaultPhoto}&width=140&height=140" alt="{$aGallery.name}"></a>
				</figure>
			{/if}
			<h3><a href="{$aGallery.url}" title="{$aGallery.name}">{$aGallery.name}</a></h3>
			{if !empty($aGallery.categories)}
				<small class="timeCat">
					Categories:
					{foreach from=$aGallery.categories item=aCategory name=category}
						<a href="/galleries/?category={$aCategory.id}" title="Galleries in {$aCategory.name}">{$aCategory.name}</a>{if $smarty.foreach.category.last == false},{/if}
					{/foreach}
				</small>
			{/if}
			<p>{$aGallery.description}</p>
		</article>
	{foreachelse}
		<p>No galleries.</p>
	{/foreach}

	{if $aPaging.next.use == true}
		<p class="pull-right"><a href="{preserve_query option='page' value=$aPaging.next.page}">Next &raquo;</a></p>
	{/if}
	{if $aPaging.back.use == true}
		<p class="pull-left"><a href="{preserve_query option='page' value=$aPaging.back.page}">&laquo; Back</a></p>
	{/if}

{include file="inc_footer.tpl"}