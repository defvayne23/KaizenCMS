{include file="inc_header.tpl" page_title="Login" page_login=1}
{if $smarty.get.error}
	<script type="text/javascript">
	$(document).ready(function(){ldelim}
		$("#content").effect("shake", {ldelim} times:1 {rdelim}, 100);
	{rdelim});
	</script>
{/if}
<form name="login" method="post" action="/admin/login/">
	<label>Username:</label>
	<input type="text" class="text" name="username" maxlength="100"><br>
	<label>Password:</label>
	<input type="password" class="text" name="password" maxlength="100"><br>
	<input type="submit" value="Login" class="btn ui-button ui-corner-all ui-state-default">
</form>
{include file="inc_footer.tpl"}