{include file="inc_header.tpl" page_title="Users :: Add User" menu="users"}
<form method="post" action="/admin/users/add/s/">
	<label>*Username:</label>
	<input type="text" name="username" maxlength="100" value="{$aUser.username}"><br>
	<label>*Password:</label>
	<input type="text" name="password" maxlength="100" value="{$aUser.password}"><br>
	<label>*Email:</label>
	<input type="text" name="email_address" maxlength="100" value="{$aUser.email_address}"><br>
	<label>First Name:</label>
	<input type="text" name="fname" maxlength="100" value="{$aUser.fname}"><br>
	<label>Last Name:</label>
	<input type="text" name="lname" maxlength="100" value="{$aUser.lname}"><br>
	<div class="clear">&nbsp;</div>
	<fieldset id="fieldset_categories">
		<p class="selectOptions">Select: <a href="#" class="checkAll">All</a>, <a href="#" class="uncheckAll">None</a></p>
		<legend>Privileges:</legend>
		<ul>
			{foreach from=$aAdminMenu item=aMenu key=x}
				<li>					
					<input id="menu_{$aMenu.id}" type="checkbox" name="privlages[]" value="{$x}"
						{if in_array($x, $aUser.privlages)} checked="checked"{/if}>
					<label style="display: inline;" for="menu_{$aMenu.id}">{$aMenu.title|clean_html}</label>
				</li>
			{/foreach}
		</ul>
	</fieldset>
	<input type="submit" value="Add User"> <input type="button" value="Cancel" onclick="location.href = '/admin/users/';">
</form>
{include file="inc_footer.tpl"}