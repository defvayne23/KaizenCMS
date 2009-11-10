{include file="inc_header.tpl" page_title="News"}

<h2>{$aArticle.title|htmlspecialchars|stripslashes}</h2>
<small class="timeCat"><time>{$aArticle.datetime_show|date_format:"%b %e, %Y - %l:%M %p"}</time> | Categories: {$aArticle.categories}</small>
<p>
	{$aArticle.content|stripslashes}<br />
</p>

{include file="inc_footer.tpl"}