<div style="margin: 5px; text-align: justify;font-size: 1.1em;	padding: 0.2em;">
<center><big>Administración de Estad&iacute;sticas</big></center><br>
<center>Listado de estad&iacute;sticas</center><br>
<br>
<center>Listado de los 25 recursos más accedidos</center>
{$listadoRecur}
<br>
<center>Listado de los 25 documentos más visitados</center>
{$listadoDocu}
<br>
<center>Listado de los ultimos Eventos</center>

{if $listadoRegistros != null}
<br>
<center>Relacion de los ultimos usuarios registrados</center>
{$listadoRegistros}
{/if}

{if $listadoEdicion != null}
<br>
<center>Relacion de los ultimos usuarios editados</center>
{$listadoEdicion}
{/if}

{if $listadoSolicitud != null}
<br>
<center>Relacion de las ultimas solicitudes</center>
{$listadoSolicitud}
{/if}

{if $listadoConceder != null}
<br>
<center>Relacion de las ultimas solicitudes concedidas</center>
{$listadoConceder}
{/if}

{if $listadoVerdoc != null}
<br>
<center>Relacion de los ultimos documentos vistos</center>
{$listadoVerdoc}
{/if}

{if $listadoVerrsc != null}
<br>
<center>Relacion de los ultimos recursos vistos</center>
{$listadoVerrsc}
{/if}

</div>