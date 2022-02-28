<h1>intentospagos</h1>
<hr>
<table>
  <thead>
    <tr>
      <td>Código</td>
      <td>Fecha</td>
      <td>Cliente</td>
      <td>Monto</td>
      <td>FechaVen</td>
      <td>Estado</td>
      <td><a href="index.php?page=mnt.intentospagos.intentospagos&mode=INS&id=0">Nuevo</a></td>
    </tr>
  </thead>
  <tbody>
    {{foreach intentospagos}}
      <tr>
        <td>{{id}}</td>
        <td>
          <a href="index.php?page=mnt.intentospagos.intentospagos&mode=DSP&id={{id}}">{{cliente}}</a>
        </td>
        <td>{{estado}}</td>
        <td>
          <a href="index.php?page=mnt.intentospagos.intentospagos&mode=UPD&id={{id}}">Editar</a>
          &nbsp;
          <a href="index.php?page=mnt.intentospagos.intentospagos&mode=DEL&id={{id}}">Eliminar</a>
          </td>
      </tr>
    {{endfor intentospagos}}
  </tbody>
</table>
