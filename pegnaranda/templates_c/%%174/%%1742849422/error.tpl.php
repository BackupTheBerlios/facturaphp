<?php /* Smarty version 2.6.1, created on 2004-09-13 15:49:18
         compiled from error.tpl */ ?>
<table border="0" cellspacing="0" cellpadding="0" width="588">
	<tr valign="middle">
		<td align="center">
			<br>
			<table border="0" cellspacing="0" cellpadding="0" width="400">
				<tr>
					<td colspan="3" align="center" width="100%"><big>Se ha producido el siguiente error:</big><br></td>
				</tr>
				<tr>
					<td width="72" ></td>
					<td align="center" style="align: center; background-color: #ff0000; color: #000000; font-size: 14px; font-weight: 900; text-align: center;	border-width: 1px;	border-color: black;	margin: 3px;display: block;">
						<?php echo $this->_tpl_vars['mensaje']; ?>

					</td>
					<td width="71" ></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php echo $this->_tpl_vars['jscript']; ?>